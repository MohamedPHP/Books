$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();

    $('select').material_select();

    $('.materialboxed').materialbox();

    $('ul.tabs').tabs();


    $('textarea').characterCounter();


    $('.like').on('click', function(e){
      e.preventDefault();
      // get the id
      bookid = $(this).parents('.mdl-grid').data('id');
      // check if the element have previous element siblings
      var isLike = this.previousElementSibling == null;
      // make ajax call
      $.ajax({
         method: 'POST',
         url: urlLike, // found in the single.blade.php
         data: {isLike: isLike, bookId: bookid, _token: token}
      })
      .done(function(res) {
         var like = res['like'] === undefined ? 'No One Liked' : res['like'] === 0 ? 'No One Liked' :  res['like'] + ' Likes';

         var dislike = res['dislike'] === undefined ? 'No One Disliked' : res['dislike'] === 0 ? 'No One Disliked' : res['dislike'] + ' Dislikes';

         $('#liked').html(like);

         $('#disliked').html(dislike);

         if(isLike) { // if true
            e.target.innerText == 'LIKE' ? e.target.innerText = 'You Like This Book' : e.target.innerText = 'LIKE';
            e.target.nextElementSibling.innerText = 'DISLIKE';
         } else {
            e.target.innerText == 'DISLIKE' ? e.target.innerText = 'You Don\'t Like This Book' : e.target.innerText = 'DISLIKE';
            e.target.previousElementSibling.innerText = 'LIKE';
         }
      });
   });


});
