$(document).ready(function() {
    $('.button-collapse').sideNav();

    $('.collapsible').collapsible();

    $('select').material_select();

    $('.materialboxed').materialbox();

    $('textarea').characterCounter();
    var subject = $('#subject_id');
    /*
    ** level_id
    ** specialization_id
    ** subject_id
    */
    $('#level_id').on('change', function () {
      clearSubject();
      var idOne = $(this).find('option:selected').val();
          idTwo = $('#specialization_id').find('option:selected').val();
      if (idTwo !== '') {
         $.ajax({
            method: 'POST',
            url: url,
            data: {idOne: idOne, idTwo: idTwo, _token: token},
         }).done(function (result) {

            subject.append(result['result']);
            subject.parents('div.input-field').slideDown(500);
            subject.material_select();
         });
      }

      if (subject.find('option:selected').val() == '') {
         clearSubject();
      }

   });

   $('#specialization_id').on('change', function () {
      clearSubject();
      var idTwo = $(this).find('option:selected').val();
          idOne = $('#level_id').find('option:selected').val();
      if (idOne !== '') {
         $.ajax({
            method: 'POST',
            url: url,
            data: {idOne: idOne, idTwo: idTwo, _token: token},
         }).done(function (result) {

            subject.html(result['result']);
            subject.parents('div.input-field').slideDown(500);
            subject.material_select();
         });
      }

      if (subject.find('option:selected').val() == '') {
         clearSubject();
      }

   });

   function clearSubject() {
      subject.html('');
      subject.parents('div.input-field').slideUp(500);
   }

});
