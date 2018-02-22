$(document).ready(function(){

	/*$('#jstree_demo').jstree({
	  "core" : {
	    "animation" : 0,
	    "check_callback" : true,
	    "themes" : { "stripes" : true },
	    'data' : {
	      'url' : function (node) {
	        return node.id === '#' ?
	          '/assets/scripts/plugins/jstree/root.json' : '/assets/scripts/plugins/jstree/root.json';
	      },
	      'data' : function (node) {
	        return { 'id' : node.id };
	      }
	    }
	  },
	  "types" : {
	    "#" : {
	      "max_children" : 1,
	      "max_depth" : 4,
	      "valid_children" : ["root"]
	    },
	    "root" : {
	      "icon" : "/static/3.3.1/assets/images/tree_icon.png",
	      "valid_children" : ["default"]
	    },
	    "default" : {
	      "valid_children" : ["default","file"]
	    },
	    "file" : {
	      "icon" : "glyphicon glyphicon-file",
	      "valid_children" : []
	    }
	  },
	  "plugins" : [
	    "contextmenu", "dnd", "search",
	    "state", "types", "wholerow"
	  ]
	});*/

	$('#jstree_demo').jstree({
	    'core' : {
	    	"themes" : { "stripes" : true },
	        'data' : {
	            'url' : "/aphcanvas-json", 
	              'data' : function (node) {
	                  return { 'id' : node.id };
	              }
	        }
	    },

	});

	$(document).on('click', '.jstree-clicked', function(){
		window.open($(this).attr('href'), '_blank');
	});

});