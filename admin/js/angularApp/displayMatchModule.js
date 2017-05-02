var myApp = angular.module('myApp', []);
myApp.controller('itemCtrl', function($scope, $http) {
	console.log("IN ANGULAR");

	jQuery(document).ready(function(){
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
			              //jQuery("#replaceable").replaceWith(obj);
			              angularAJAX();
			        },
			error: function(errorThrown){
				alert(errorThrown);
			}

		});
		return false;
	});

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
			              //jQuery("#replaceable").replaceWith(obj);
			              angularAJAX();
			        },
			error: function(errorThrown){
				alert(errorThrown);
			}

		});
		return false;
	});

});

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

angularAJAX();

});

