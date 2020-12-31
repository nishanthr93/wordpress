/*global
 $, wpflow_ajax, jslint, alert
 */
var gaeAjax = ( function ( $ ) {

  $(document).ready( function ( $ ) {

    // Handle twitter bootstrap modals
    if (typeof $.fn.modal.noConflict !== "undefined") {
      var bootstrapModal = $.fn.modal.noConflict();
    }

    // Form Submit
    $.validate();
    $(".wpgae-event-form").on('submit', submitEventForm);
    // Populate and Show the edit event modal
    $(".ga_main .edit a").click(openAndPoplulateEventModal);
    // Populate and Show the Delete event modal
    $(".ga_main .delete a").click(openAndPoplulateEventModal);
  });


  function openAndPoplulateEventModal(e) {
    e.preventDefault();
    var id_post = $(this).attr('id');
    var modalId = "#" + $(this).data("action");
    $.ajax({
      type: 'POST',
      url: wpflow_ajax.ajax_url,
      data: {
        'post_id': id_post,
        'action': 'wpflow_get_event_json'
      },
      success: function (result) {
        $(modalId).modal();
        populateMetaEditForm(modalId, result.meta);
        $(modalId + " #event_id").val(id_post);
      },
      error: function () {
        alert("Error updating event");
      }
    });
  }

  function submitEventForm(e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
      type: "post",
      url: wpflow_ajax.ajax_url,
      data: form.serialize(),
      success: function (data) {
        window.location.reload();
      }
    });
  }
  
  function populateMetaEditForm(modal, meta) {
    if (typeof meta !== "undefined") {
      for (var input in meta) {
        if (meta.hasOwnProperty(input)) {
          if ($(modal + " #" + input).is(":checkbox")) {
            if (meta[input][0] === "true") {
              $(modal + " #" + input).attr("checked", true);
            } else {
              $(modal + " #" + input).removeAttr("checked", false);
            }
          } else {
            $(modal + " #" + input).val(meta[input][0]);
          }
        }
      }
    }
  }
} )( jQuery );






 