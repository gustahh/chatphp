
const tabs = document.querySelectorAll("a");
const load = document.getElementById("content");

const scriptAttributes = {
   type: true,
   src: true,
   nonce: true,
   noModule: true,
   accept: true,
   async: true,
   defer: true
};

// Create ajax fn
function ajax( url, callback ) {
   var xhr = new window.XMLHttpRequest();
   xhr.open("GET", url + "?rel=tab", true );
   xhr.onload = function() {
      if ( xhr.readyState === xhr.DONE && ( xhr.status >= 200 && xhr.status < 300 ) ) {
         if ( typeof callback === "function" ) {
            callback.call(
               this, this.response, this.statusText
            );
         }
      }
   }
   xhr.send();
}

tabs.forEach( function( elem ) {
   elem.addEventListener("click", function( e ) {
      e.preventDefault();
      var url, matchURL;

      url = this.getAttribute( "href" );
      matchURL = document.createElement("a");
      matchURL.href = url;
      matchURL = matchURL.href;

      ajax( url, function( data, _status ) {
         html( [ load ], data );
      });

      if ( window.location.href !== matchURL ) {
         window.history.pushState( { url: url }, '', url );
         return;
      }
   });
});

window.addEventListener("popstate", function() {
   ajax( this.window.location.pathname, function( data, _status ) {
      html( [ load ], data );
   });
});

// Create domEval fn method
function domEval( code, node ) {
   var i, val,
      doc = document,
      script = doc.createElement("script");

   script.text = code;
   if ( node ) {
      for ( i in scriptAttributes ) {
         val = node[ i ] && node.getAttribute( i );
         if ( val ) {
            script.setAttribute( i, val );
         }
      }
   }
   doc.head.appendChild( script ).parentNode.removeChild( script );
}

// Create getAll fn method 
function getAll( context, tag ) {
   var ret;
   if ( typeof context.querySelectorAll !== "undefined" ) {
      ret = context.querySelectorAll(tag);
   } else {
      ret = [];
   }

   if ( tag ) {
      [].push.apply( [ context ], ret );
   }
   return ret;
}

// Build/Make a document fragment creating buildFragment function
function buildFragment( elems ) {
   var elem, tmp,
      fragment = document.createDocumentFragment(),
      i = 0,
      rhtml = /<|&#\w+;/,
      nodes = [];

   for ( ; i < elems.length; i++ ) {
      elem = elems[ i ];
      if ( elem ) {
         if ( typeof elem === "object" ) {
            elem.nodeType ? nodes.push( elem ) :
               [].push.apply( nodes, elem );
         } else if ( !rhtml.test( elem ) ) {
            nodes.push( document.createTextNode( elem ) );
         } else {
            tmp = document.createElement("div");
            tmp.innerHTML = elem;
            [].push.apply( nodes, tmp.childNodes );
         }
      }
   }

   i = 0;
   while( ( elem = nodes[ i++ ] ) ) {
      fragment.appendChild( elem );
   }

   return fragment;
}

function manipulate( collection, args, fn ) {

   var fragment, scripts, hasScript, node, first,
      i = 0, 
      l = collection.length,
      noClone = l - 1;

   if ( l ) {
      fragment = buildFragment( args );
      first = fragment.firstChild;

      if ( fragment.childNodes.length === 1 ) {
         fragment = first;
      }

      if ( first ) {
         scripts = getAll( fragment, "script" );
         hasScript = scripts.length;
      }

      for ( ; i < l; i++ ) {
         node = fragment;

         if ( i !== noClone ) {
            node = node.cloneNode( true );
            if ( hasScript ) {
               [].push.apply(
                  scripts, getAll( node, "script" )
               );
            }
         }

         fn.call( collection[ i ], node, i );
      }

      if ( hasScript ) {
         for ( i = 0; i < hasScript; i++ ) {
            node = scripts[ i ];
            domEval( node.textContent, node );
         }
      }
   }
   return collection;
}

// Create html function method with <= support script
function html( elems, data ) {
   var i = 0,
      self = elems[ 0 ],
      length = elems.length,
      rnoinnerhtml = /<(link|script|style)/i;

   if ( data == null ) {
      return self.innerHTML;
   }

   if ( typeof data === "string" && !rnoinnerhtml.test( data ) ) {
      for ( ; i < length; i++ ) {
         elems[ i ].innerHTML = data;
      }
   } else {
      // empty innerHTML of elems
      for ( ; i < length; i++ ) {
         elems[ i ].innerHTML = "";
      }

      manipulate( elems, [ data ], function( elem ) {
         this.appendChild( elem );
      } );
   }
}