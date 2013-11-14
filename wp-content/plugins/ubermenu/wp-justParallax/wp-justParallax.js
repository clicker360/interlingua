/* =============================================================*
* justParallax.js v2.5
* Developer: Martin Drost
* Documentation: http://www.martindrost.nl/justParallax
* 
* Tests approved: IE6+, Google Chrome, Mozilla Firefox, Safari, Opera
*==============================================================*/
function initParallax(settings)
{
	parallax_settings = {target: select('body'),speed: 8, vertical: true, vertical_inversed: false, horizontal: false, horizontal_inversed: false};
	!settings && (settings = {});
	settings.target && (parallax_settings.target = select(settings.target));
	settings.speed && (parallax_settings.speed = settings.speed);
	settings.vertical === false && (parallax_settings.vertical = settings.vertical);
	settings.vertical_inversed && (parallax_settings.vertical_inversed = settings.vertical_inversed);
	settings.horizontal && (parallax_settings.horizontal = settings.horizontal);
	settings.horizontal_inversed && (parallax_settings.horizontal_inversed = settings.horizontal_inversed);
	document.body.style.backgroundAttachment != 'fixed' && (document.body.style.backgroundAttachment  = 'fixed');

	window.addEventListener && (window.addEventListener('scroll', moveBackground, false));
	!window.addEventListener && window.attachEvent && (window.attachEvent('onscroll', moveBackground));
	
	function moveBackground()
	{
		var scrolltop_offset = window.scrollY||(document.documentElement||document.body.parentNode||document.body).scrollTop, 
		       background_position = scrolltop_offset/parallax_settings.speed,
		       vertical_position =  parallax_settings.vertical ? background_position : 0,
		       horizontal_position = parallax_settings.horizontal ? background_position : 0,
		       horizontal_inversed = parallax_settings.horizontal_inversed?'':'-',
		       vertical_inversed = parallax_settings.vertical_inversed?'':'-';

		for(var i=0,l=parallax_settings.target.length;i<l;i++)
		{
			parallax_settings.target[i].style.backgroundPosition = horizontal_inversed+horizontal_position+'px '+vertical_inversed+vertical_position+'px';
		}
	};
	moveBackground();
}
window.onLoad = initParallax(justParallax_settings);

function select(selection)
{
    var select_array = [],
        targets = selection.split(','),
        doc = document;
    for(var i=targets.length;i>0;i--)
    {
        var item = targets[i-1],
            is_id = is_class = is_tag = false;
    
        item.indexOf('#') !== -1 && (is_id = true) ||
        item.indexOf('.') !== -1 && (is_class = true) ||
        (is_tag = true);
        
        var regex = /[.#\s]/g;
        item = item.replace(regex,'');
        var selected =  is_id && (doc.getElementById(item)) ||
                        is_class && (doc.getElementsByClassName && doc.getElementsByClassName(item) || getElementsByClassName(doc.body,item)) ||
                        is_tag && (doc.getElementsByTagName(item));
                
        select_array = mergeArrays(select_array,selected);
    }
    return select_array;
}

//Fallback for IE8 and lower
function getElementsByClassName(parent, class_name) 
{
    var array = [],
        regex = new RegExp('(^| )'+class_name+'( |$)'),
        elements = parent.getElementsByTagName("*");

    var i = elements.length?elements.length:0;
    !i && regex.test(elements.className) && (array[0] = elements);
    for(;i>0;i--)
    {
        var item = elements[i-1];
        regex.test(item.className) && (array[array.length] = item);
    }
    return array;
}

function mergeArrays(array, add_array) 
{
    var l = array.length;
    var i = add_array.length?add_array.length+l:0;
    !i && (array[l] = add_array);
    for(;i>l;i--)array[i-1] = add_array[i-1];
    return array;
}