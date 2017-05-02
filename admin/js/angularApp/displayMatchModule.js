var myApp = angular.module('myApp', []);
myApp.controller('itemCtrl', function($scope, $http) {
	console.log("IN ANGULAR");


	jQuery(document).ready(function(){
		//standard click function for submission of a To Do item
		jQuery( "#addToDo").click(function() {
			var title = jQuery('#wptd_title').val();
			var desc = jQuery('#wptd_description').val();
			jQuery("#wptd_title").val("Title for your new To Do Items");
			jQuery("#wptd_description").val("To Do description")
			console.log(ajax_object.ajax_url);

			jQuery.ajax({
				type: "POST",
				url: ajax_object.ajax_url,
				data: {
					action : "ajaxConversion", 
					title : title,
					description : desc

				},
				success: function (obj) {
				              angularAJAX();
				        },
				error: function(errorThrown){
					alert(errorThrown);
				}

			});
			return false;
		});

		//jQuery delegate event handler
		//a regular on event handler is a direct handle and doesn't work on my dynamically generated radio buttons
		jQuery("#checkboxes").delegate("input", "change", function(e) {
			
			var target = e.target;
			var itemID = jQuery(target).attr('id');
			itemID = itemID.replace('item','');
			console.log(itemID);

			jQuery.ajax({
				type: "POST",
				url: ajax_object.ajax_url,
				data: {
					action : "ajaxUpdate", 
					item : itemID

				},
				success: function (obj) {
				              angularAJAX();
				        },
				error: function(errorThrown){
					alert(errorThrown);
				}

			});
			return false;
		});

	});

	//allows the angular app to be updated each time a radio dial is clicked or a To Do item is added
	function angularAJAX(){
	    jQuery.ajax({
			type: "POST",
			url: ajax_object.ajax_url,
			data: {
				action : "updateToDo"
			},
			success: function (obj) {
				console.log(JSON.parse(obj));
			           $scope.items = JSON.parse(obj);
			           $scope.$apply();
			        },
			error: function(errorThrown){
				console.log(errorThrown);
			}

		});
	}

//for the initial load of the wordpress page
angularAJAX();
});