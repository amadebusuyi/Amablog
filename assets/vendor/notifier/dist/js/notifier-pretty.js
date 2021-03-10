! function ( root, factory )
{
	"object" == typeof exports && "object" == typeof module ? module.exports = factory() : "function" == typeof define && define.amd ? define( [], factory ) : "object" == typeof exports ? exports.notifier = factory() : root.notifier = factory()
}( "undefined" != typeof self ? self : this, function ()
{
	var count = 0,
		d = document,
		myCreateElement = function ( elem, attrs )
		{
			var el = d.createElement( elem );
			for ( var prop in attrs ) el.setAttribute( prop, attrs[ prop ] );
			return el
		},
		createContainer = function ()
		{
			var container = myCreateElement( "div",
			{
				"class": "notifier-container",
				id: "notifier-container"
			} );
			d.body.appendChild( container )
		},
		show = function ( title, msg, type, icon, timeout )
		{
			"number" != typeof timeout && ( timeout = 0 );
			var ntfId = "notifier-" + count,
				container = d.querySelector( ".notifier-container" ),
				ntf = myCreateElement( "div",
				{
					"class": "notifier " + type
				} ),
				ntfTitle = myCreateElement( "h2",
				{
					"class": "notifier-title"
				} ),
				ntfBody = myCreateElement( "div",
				{
					"class": "notifier-body"
				} ),
				ntfImg = myCreateElement( "div",
				{
					"class": "notifier-img"
				} ),
				img = myCreateElement( "img",
				{
					"class": "img",
					src: icon
				} ),
				ntfClose = myCreateElement( "button",
				{
					"class": "notifier-close",
					type: "button"
				} );
			return ntfTitle.innerHTML = title, ntfBody.innerHTML = msg, ntfClose.innerHTML = "&times;", icon.length > 0 && ntfImg.appendChild( img ), ntf.appendChild( ntfClose ), ntf.appendChild( ntfImg ), ntf.appendChild( ntfTitle ), ntf.appendChild( ntfBody ), container.appendChild( ntf ), ntfImg.style.height = ntfImg.parentNode.offsetHeight + "px" || null, setTimeout( function ()
			{
				ntf.className += " shown", ntf.setAttribute( "id", ntfId )
			}, 100 ), timeout > 0 && setTimeout( function ()
			{
				hide( ntfId )
			}, timeout ), ntfClose.addEventListener( "click", function ()
			{
				hide( ntfId )
			} ), count += 1, ntfId
		},
		hide = function ( notificationId )
		{
			var notification = document.getElementById( notificationId );
			return !!notification && ( notification.className = notification.className.replace( " shown", "" ), setTimeout( function ()
			{
				notification.parentNode.removeChild( notification )
			}, 600 ), !0 )
		};
	return createContainer(),
	{
		show: show,
		hide: hide
	}
} );