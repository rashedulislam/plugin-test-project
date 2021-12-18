(function( $ ) {
	'use strict';

	$(document).ready(function() {
        let wrapper         = $(".input-form");
        let add_button      = $(".task-add-more");
    
        $(add_button).click(function(e){
            e.preventDefault();
                $(add_button).before('<input type="text" name="name">');
        });

    });

    $(document).ready(function() {
        let wrapper         = $(".input-form");
        let submit_button      = $(".task-save");
    
        $( submit_button ).click(function (e) {
            e.preventDefault();

            let employees = [];

            $( '.input-form input[name="name"]').each(function() {
                employees.push(this.value);
            });

            jQuery.ajax({
                url: TaskLocalize.ajaxurl,
                type: 'POST',
                data: {
                    action: 'add_task',
                    security: TaskLocalize.task_nonce,
                    employees: employees,
                },
                success: function (data) {
                    console.log(data)
                },
            })
            
        });

    });

})( jQuery );
