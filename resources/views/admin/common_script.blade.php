    <script type="text/javascript">
        $(document).ready(function() {
            $('.date-picker').datetimepicker({
                format: 'L'
            });
            $('.datetime-picker').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            $('.date-range-picker').daterangepicker();

            $(".date-range-picker, .date-picker, .date-range-picker").change(function() {
                this.dispatchEvent(new InputEvent('input'));
            });

            $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
            });





            // START Popover
            $('[data-toggle="popover"]').popover();
            // END Popover

            // START Menu
            //var current = location.pathname;
            var current = window.location.href;
            $('.sidebar nav li a').each(function() {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href') === current) {
                    $this.addClass('active');
                }
            });
            $('ul.nav-treeview a.active').parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev(
                'a');
            // END Menu

            // START Filter Forms - Floting Forms
            $('.floating').on('focus change', function(e) {
                $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value
                    .length > 0));
            }).trigger('blur');
            // End Filter Forms - Floting Forms

            // START Alert
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if ($message = session('alert_danger'))
                Toast.fire({
                icon: 'error',
                title: '{{ $message }}'
                });
            @endif

            @if ($message = session('alert_success'))
                Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
                });
            @endif

            @if ($message = session('alert_warning'))
                Toast.fire({
                icon: 'warning',
                title: '{{ $message }}'
                });
            @endif
            // End Alert
            

            //Go TOP Button
            let mybutton = document.getElementById("btn-back-to-top");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
            scrollFunction();
            };

            function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }
            // When the user clicks on the button, scroll to the top of the document
            mybutton.addEventListener("click", backToTop);

            function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            }     
        });


        document.addEventListener('livewire:load', function() {
            //refreshSelectPicker();
            // setInterval(() =>  {   
                window.livewire.on('focus-input-name', input => {
                $("input[name='"+input+"']").focus();      
            });
            window.livewire.on('focus-id', input => {
                $("#"+input).focus();      
            });
            // }, 5000);

        });


        document.addEventListener("DOMContentLoaded", () => {
            applySelectPicker();          
            
            Livewire.hook('element.updating', (fromEl, toEl, component) => {
                destroySelectPicker();
                //console.log('1');
            })

            Livewire.hook('message.processed', (message, component) => {
                applySelectPicker();     
                //console.log('2');
            })
        });



        document.addEventListener("dehydrateSelectPicker", () => {
            refreshSelectPicker();
            //console.log('3');
        
        });

        function applySelectPicker() {
            if ($('.selectpickerTemp').length > 0) {
                $('.selectpickerTemp').addClass('selectpicker').removeClass('selectpickerTemp');
            }
            if ($('.selectpicker').length > 0) {
                $('.selectpicker').each(function(index) {
                    var default_value_attr = $(this).attr('default_value');
                    if (typeof default_value_attr !== typeof undefined && default_value_attr !== false) {
                        $(this).selectpicker('val', default_value_attr.split(','));
                        $(this).removeAttr('default_value');
                    }else{
                        $(this).selectpicker({
                            liveSearch: true,
                            style: "dropdown-toggle form-control custom-select-picker bs-placeholder"
                        });
                    }
                    // this.dispatchEvent(new InputEvent('input'));
                });
                $('.select-picker-readonly').removeClass('dropdown-toggle');
            }
            $('.custom-select-picker').removeClass('btn');
        }

        
        function destroySelectPicker() {
            if ($('.selectpicker').length > 0) {
                $('.selectpicker').each(function(index) {
                    $(this).addClass('selectpickerTemp');
                    $(this).selectpicker('destroy');
                });
            }
        }


        function refreshSelectPicker() {
            if ($('.selectpicker').length > 0) {
                $('.selectpicker').each(function(index) {
                    $(this).selectpicker('refresh');
                });
            }
            if ($('.ajaxselectpicker').length > 0) {
                $('.ajaxselectpicker').each(function(index) {
                    $(this).selectpicker('refresh');
                });
            }
        }



        // START Modal
        window.addEventListener("modalClose", event => {
            modalId = event.detail.modal_id;
            $(modalId).modal('toggle');
        });

        window.addEventListener("modalOpen", event => {
            modalId = event.detail.modal_id;
            $(modalId).modal('show'); //display something
            $(modalId).focus()
        });
        // END Modal
    
</script>
