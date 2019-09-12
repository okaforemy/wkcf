$(document).ready(function() {
    /* ------------------------------------------this is ajax header setup ----------------------------- */
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
/*------------------------handles all ajax error-----------------*/

/*------------------------pulls the questions----------------*/
$(document).on('click', '#quizz-submit', function(event) {
  event.preventDefault();
  $txt_value=$('#question_no').val();
  $category=$('#category').val();
  $url=$('#url').val();
  //console.log($txt_value+'  '+$category+'  '+$url)
  $.ajax({
    url: $url,
    type: 'GET',
    dataType: 'JSON',
    data: {number: $txt_value, category: $category},
  })
  .done(function(data) {
    if(data.error){
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'This number has been taken, try another number!',
      });
      $('#quizz-question').text('');
      $('#quizz-answer').text('');
    }
    console.log(data.quizz)
     $('#quizz-question').text((data.quizz)?".   "+data.quizz.question:'Wrong Number Chosen, Please pick a new number');
     $('#quizz-ans-hidden').val((data.quizz)?data.quizz.answer:'please pick the right number');
     $('#quizz-id').val((data.quizz)?data.quiz_id:0);
     $('#quizz-answer').text('')
     

     if(data.quizz){

    }else{
      $('#btn-quizz-answer').attr('disabled',true);
    }
  })
  .fail(function(xhr) {
    console.log(xhr.responseText);
    console.log(xhr.status);
  })
  .always(function() {
    console.log("complete");
  });
  
  
});


function mark_answered(){
  $category=$('#category').val();
  console.log($category);
  $url=$('#answeredbtn').val();
  $.ajax({
    url: $url,
    type: 'GET',
    dataType: 'json',
    data:{category:$category},
  })
  .done(function(data) {
    if(data.basic_category=='basic'){
      $('#answered-btn').html(data.html);
    }
    if(data.advanced_category=='advanced'){
      $('#answered-btn').html(data.html);
    }
  })
  .fail(function(xhr) {
    console.log(xhr.responseText);
    console.log(xhr.status)
  })
  .always(function() {
    console.log("complete");
  });
}

function answere_quizz(){
  event.preventDefault();
  $answ=$('#quizz-ans-hidden').val();
  $id=$('#quizz-id').val();
  $url=$('#quizz-answered-url').val();
  $category=$('#category').val();
  if($id==0){
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Wrong ID, Please choose a number!',
      })
  }
  $.ajax({
    url: $url,
    type: 'POST',
    data: {id: $id, category:$category},
  })
  .done(function() {
    //console.log("success");
    $('#quizz-answer').text(".  "+$answ);
    mark_answered();
  })
  .fail(function(xhr) {
    console.log(xhr.responseText);
    console.log(xhr.status);
  })
  .always(function() {
    console.log("complete");
  });
}
/*---------------calling the mark answered function -------------- */
mark_answered();
/*-----------------------quizz answer---------------------*/
$(document).on('click', '#btn-quizz-answer', function(event) {
  
answere_quizz();
});

$(document).on('keydown', '#quizz-div', function(event) {
  //event.preventDefault();
  if(event.keyCode == '65'){
  answere_quizz();
 }
});


/*----------------------Edit the quiz ---------------------*/

$(document).on('click', '.edit-quizz', function(event) {
  event.preventDefault();
  $(this).siblings('.update-quizz').attr('disabled',false);
  $(this).parents('tr').children('td:nth-child(2)').attr('contenteditable',true);
  $(this).parents('tr').children('td:nth-child(3)').attr('contenteditable',true);
});

/*-----------------update the quizz--------------*/
$(document).on('click', '.update-quizz', function(event) {
  event.preventDefault();
  $id=$(this).attr('data-id');
  $url=$(this).attr('data-url');
  $question=$(this).parents('tr').children('td:nth-child(2)').text();
  $answer=$(this).parents('tr').children('td:nth-child(3)').text();
  console.log('this is the question'+$question);
  console.log('this is the answer'+$answer);
  $.ajax({
    url: $url,
    type: 'POST',
    dataType: 'json',
    data: {id:$id,question:$question,answer:$answer},
  })
  .done(function(data) {
    //console.log("success");
    if(data){
      let timerInterval
        Swal.fire({
          title: 'Update successful',
          html: 'Update was successful <strong></strong>',
          timer: 1000,
          onBeforeOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              Swal.getContent().querySelector('strong')
                .textContent = Swal.getTimerLeft()
            }, 100)
          },
          onClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.timer
          ) {
           // console.log('I was closed by the timer')
          }
        })
    }
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
});
/*--------------------delete quiz------------------*/
function delet($id,$url,$del){
   
 $.ajax({
   url: $url,
   type: 'GET',
   dataType: 'JSON',
   data: {id:$id},
 })
 .done(function(data) {
   //console.log("success");
   $('#'+$del).remove();

 })
 .fail(function(xhr) {
   console.log("error");
   console.log(xhr.responseText);
   console.log(xhr.status);
 })
 .always(function() {
   console.log("complete");
 });
}

$(document).on('click', '.delete-quizz', function(event) {
  event.preventDefault();
  $id=$(this).attr('data-id');
  $url=$(this).attr('data-url');
  $del=$(this).parents('tr').attr('id');

 Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    delet($id,$url,$del);
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
 
});



});
