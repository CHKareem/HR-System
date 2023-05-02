<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR - Management System</title>

  {{-- Favicon --}}
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/dist/img/AdminLTELogo.png')}}">

  <!-- REQUIRED CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/dist/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  {{-- <link rel="stylesheet" href="{{ asset ('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/summernote/summernote-bs4.min.css') }}"> --}}
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  @livewireStyles

  <style>
    .modal-error {
        color: #636363;
        width: 325px;
        margin: 80px auto 0;
    }
    .modal-error .btn {
        color: #fff;
        border-radius: 4px;
        background: #ef513a;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-error .btn:hover {
        background: #da2c12;
        outline: none;
    }
    .modal-error .icon-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #ef513a;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    /* Success Modal*/
    .modal-confirm {
        color: #636363;
        width: 325px;
        margin: 30px auto;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .modal-confirm .icon-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    /* Success and Error Modal */
    .modal-error .modal-content, .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-error .modal-header, .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }
    .modal-error h4, .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-error .form-control, .modal-error .btn, .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px;
    }
    .modal-error .close, .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }
    .modal-error .modal-footer, .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }
    .modal-error .icon-box i, .modal-confirm .icon-box i  {
        font-size: 56px;
        position: relative;
        top: 4px;
    }


.drop-container {
  position: relative;
  display: flex;
  gap: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 200px;
  padding: 20px;
  border-radius: 10px;
  border: 2px dashed #555;
  color: #444;
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
  background: #eee;
  border-color: #111;
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  color: #444;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
}

input[type=file] {
  width: 450px;
  max-width: 100%;
  color: #444;
  padding: 5px;
  background: #fff;
  border-radius: 10px;
  border: 1px solid #555;
}

input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 8px 10px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}

/* USER ICON */
.user-icon{
position: absolute;
right: -9em;
top:-.5em;
width: 18em;
height: 5em;
margin-bottom: 2em;
}

/* HR STYLE */

.hr-style{
    margin-top: 2em;
    margin-bottom: 1em;
}

/* SELECT STYLE */

.select2 {
width:100%!important;
}

#employeeId + .select2-container--default .select2-selection--multiple,
#centerId + .select2-container--default .select2-selection--multiple,
#positionId + .select2-container--default .select2-selection--multiple,
#departmentId + .select2-container--default .select2-selection--multiple{
    height: 80px;
    overflow-y: scroll;
    overflow-x: hidden;
    width: 100% !important;
}

/* Clear "X" */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: red;
    background-color: #fff;
    margin: 0em;
    padding-left : .5em;
    text-align: center;
}

/* Clear "X" Hover */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #fff;
    background-color: red;
    border-right-color: red;
}
/* Each Result */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #333;
    background-color: #fff;
    font-size: 1em;
    font-weight: bold;
    padding-left: 2em;
    padding-right: 1em;
}



/* Autocomplete Style */

.search-box .clear{
        clear:both;
        margin-top: 20px;
    }

    .search-box ul{
        list-style: none;
        padding: 0px;
        width: 250px;
        position: relative;
        margin: 0;
        background: white;
    }

    .search-box ul li{
        background: lavender;
        padding: 4px;
        margin-bottom: 1px;
    }

    .search-box ul li:nth-child(even){
        background: cadetblue;
        color: white;
    }

    .search-box ul li:hover{
        cursor: pointer;
    }

    .search-box input[type=text]{
        padding: 5px;
        width: 250px;
        letter-spacing: 1px;
    }

    .small-box{
        border-radius:1em;
    }

    .date-box{
        border-radius:1.5em;
    }
    
    /*  Collapse */
    .card-header .title {
    font-size: 17px;
    color: #000;
}
.card-header .accicon {
  float: right;
  font-size: 20px;  
  width: 1.2em;
}
.card-header{
  cursor: pointer;
  border-bottom: none;
}
.card{
  border: 1px solid #ddd;
}
.card-body{
  border-top: 1px solid #ddd;
}
.card-header:not(.collapsed) .rotate-icon {
  transform: rotate(180deg);
}
   
  </style>

  <!-- REQUIRED CSS -->

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img src="{{ asset ('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

  <!-- Navbar -->
    @include('layouts.partials.navbar')

  <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{ $slot }}
    </div>

  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
        </div>
    </aside>

  <!-- Main Footer -->
    @include('layouts.partials.footer')
</div>

<!-- REQUIRED SCRIPTS -->
<script src=" {{ asset ('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/adminlte.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/moment/moment.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


{{-- <script src=" {{ asset ('backend/plugins/chart.js/Chart.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/sparklines/sparkline.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src=" {{ asset ('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/moment/moment.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src=" {{ asset ('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src=" {{ asset ('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/adminlte.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/demo.js') }}"></script>
<script src=" {{ asset ('backend/dist/js/pages/dashboard.js') }}"></script> --}}
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script>
    $.widget.bridge('uibutton', $.ui.button)
</script> --}}

{{-- <script>
    $(document).ready( function() {
        $('#birthdate').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        })

        $('#birthdate').on("change.datetimepicker", function(e)
        {
            alert('he');
        }
        )
    })
</script> --}}

<script>
    $(document).ready(function() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // Attendees
    window.addEventListener('show_attendees_form', event => {
        $('#attendees-form').modal('show');
    })
    window.addEventListener('show_error_model', event => {
        $('#attendees-form').modal('hide');
        toastr.success(event.detail.message, 'Error!');
    })

    // Employees

    window.addEventListener('show_success_message', event => {
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_update_message', event => {
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_position_employer_form', event => {
        $('#position-employer-form').modal('show');
    })
    window.addEventListener('show_employer_form', event => {
        $('#employer-form').modal('show');
    })
    window.addEventListener('hide_employer_form', event => {
        $('#employer-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_holiday_form', event => {
        $('#holiday-form').modal('show');
    })

    window.addEventListener('hide_holiday_form', event => {
        $('#holiday-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('error_holiday_form', event => {
        toastr.error(event.detail.message, 'Error!');
    })
    window.addEventListener('show_unlink_conformation_model', event => {
        $('#unlink-conformation-model').modal('show');
    })
    window.addEventListener('hide_unlink_conformation_model', event => {
        $('#unlink-conformation-model').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_relink_conformation_model', event => {
        $('#relink-conformation-model').modal('show');
    })
    window.addEventListener('hide_relink_conformation_model', event => {
        $('#relink-conformation-model').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_delete_conformation_model', event => {
        $('#delete-conformation-model').modal('show');
    })
    window.addEventListener('show_info_conformation_model', event => {
        $('#info-conformation-model').modal('show');
    })
    window.addEventListener('show_conformation_model', event => {
        $('#conformation-model').modal('show');
    })
    window.addEventListener('hide_conformation_model', event => {
        $('#conformation-model').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('show_import_form', event => {
        $('#import-form').modal('show');
    })

    // Centers
    window.addEventListener('show_center_form', event => {
        $('#center-form').modal('show');
    })
    window.addEventListener('hide_center_form', event => {
        $('#center-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_center_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    // Departments
    window.addEventListener('show_department_form', event => {
        $('#department-form').modal('show');
    })
    window.addEventListener('hide_department_form', event => {
        $('#department-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_department_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    // Postiions
    window.addEventListener('show_position_form', event => {
        $('#position-form').modal('show');
    })
    window.addEventListener('hide_position_form', event => {
        $('#position-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('success_postiion_form', event => {
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_info_employees_position_model', event => {
        $('#info-employees-position-model').modal('show');
    })

    // Vacations

    window.addEventListener('show_vacation_form', event => {
        $('#vacation-form').modal('show');
    })
    window.addEventListener('show_conformation_model_type', event => {
        $('#conformation-model-type').modal('show');
    })
    window.addEventListener('hide_conformation_model_type', event => {
        $('#conformation-model-type').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_new_daily_vacation_form', event => {
        $('#new-daily-vacation-form').modal('show');
    })
    window.addEventListener('hide_new_daily_vacation_form', event => {
        $('#new-daily-vacation-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_new_hourly_vacation_form', event => {
        $('#new-hourly-vacation-form').modal('show');
    })
    window.addEventListener('hide_new_hourly_vacation_form', event => {
        $('#new-hourly-vacation-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_employee_vacations_form', event => {
        $('#employee-vacations-form').modal('show');
    })

    window.addEventListener('show_conformation_model_employees_vacations', event => {
        $('#conformation-model-vacations').modal('show');
    })
    window.addEventListener('hide_conformation_model_employees_vacations', event => {
        $('#conformation-model-vacations').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('show_employee_vacation_form', event => {
        $('#employee-vacation-form').modal('show');
    })

    window.addEventListener('hide_employee_vacation_form', event => {
        $('#employee-vacation-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('no_hide_conformation_model', event => {
        $('#conformation-model').modal('hide');
        toastr.error(event.detail.message, 'Error!');
    })

        // Discounts

        window.addEventListener('show_employee_absences_model', event => {
        $('#employee-absences-form').modal('show');
    })
    window.addEventListener('show_employee_noPayment_health_model', event => {
        $('#employee-noPayment-health-form').modal('show');
    })

    // Tasks
    window.addEventListener('show_new_daily_task_form', event => {
        $('#new-daily-task-form').modal('show');
    })
    window.addEventListener('hide_new_daily_task_form', event => {
        $('#new-daily-task-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_new_hourly_task_form', event => {
        $('#new-hourly-task-form').modal('show');
    })
    window.addEventListener('hide_new_hourly_task_form', event => {
        $('#new-hourly-task-form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })
    window.addEventListener('show_employee_tasks_form', event => {
        $('#employee-tasks-form').modal('show');
    })

    $('#myTable').dataTable();
})
</script>

<script type="text/javascript">
    $(document).ready(function() {
    @if (count($errors) > 0)
        $('#errorModal').modal('show');
    @endif

    @if(Session::get('success'))
    $('#confirmModal').modal('show');
    @endif

    $('#myTable').dataTable();

    $(".EditIcon").tooltip({
    placement: "bottom",
    title: 'Edit',
    html: true,
  });

  $(".DeleteIcon").tooltip({
    placement: "bottom",
    title: 'Delete',
    html: true,
  });

  $(".InfoIcon").tooltip({
    placement: "bottom",
    title: 'Info',
    html: true,
  });

  $(".UnlinkIcon").tooltip({
    placement: "bottom",
    title: 'Unlink',
    html: true,
  });

  $(".RelinkIcon").tooltip({
    placement: "bottom",
    title: 'Relink',
    html: true,
  });

});

document.addEventListener("DOMContentLoaded", () => {
Livewire.hook('element.updated', (el, component) => {

    $(".EditIcon").tooltip({
    placement: "bottom",
    title: 'Edit',
    html: true,
  });

  $(".DeleteIcon").tooltip({
    placement: "bottom",
    title: 'Delete',
    html: true,
  });

  $(".InfoIcon").tooltip({
    placement: "bottom",
    title: 'Info',
    html: true,
  });

  $(".UnlinkIcon").tooltip({
    placement: "bottom",
    title: 'Unlink',
    html: true,
  });

  $(".RelinkIcon").tooltip({
    placement: "bottom",
    title: 'Relink',
    html: true,
  });

});
});

</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $('.select2').select2({});

});

</script>

@stack('js')
@stack('js2')
@stack('js3')
@livewireScripts
<!-- REQUIRED SCRIPTS -->

</body>
</html>
