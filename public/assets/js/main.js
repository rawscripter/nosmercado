


// post file drop option js
var fileInput = document.querySelector('input[type=file]');
var filenameContainer = document.querySelector('#filename');
var dropzone = document.querySelector('div');

fileInput.addEventListener('change', function() {
	filenameContainer.innerText = fileInput.value.split('\\').pop();
});

fileInput.addEventListener('dragenter', function() {
	dropzone.classList.add('dragover');
});

fileInput.addEventListener('dragleave', function() {
	dropzone.classList.remove('dragover');
});

//end post file drop option js

// menu js 
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}

// menu toggle function
$('.menu_single_row').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */
  // $(this).next().slideToggle('400');    
  // $('.home_ad_bar_content').slideToggle('400');
  $(this).children('.menu_single_item').slideToggle('100');
  // $(this).find('.adv_sing_open_icon').slideToggle('fast');
  // $(this).find('.adv_sing_close_icon').slideToggle('fast');
  

});

// menu js end
