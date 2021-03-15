$(".subMenu").css("display","none");
$(document).ready( function () {
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
let poke = 0;
var formPerso = $("#bouton-fermeture-form-perso");




var feculent = $('.feculent');
var legume = $('.legumes');
var proteine =	$('.proteines');
var feculentChoix;
var proteineChoix;
var legumeChoix;

$(feculent).change(function(event){
	if($(this).prop("checked")){
	feculentChoix = event.target.attributes.id.value;
	}
	$.ajax({
		url:"http://localhost/projet-Pro/global/content/pouet3.php",
		method:"POST",
		data:{
			"feculent":feculentChoix
		},
		success:(data)=>{
			console.log(data);
			if(data == "OK"){
				console.log(feculentChoix);
			}
		},
		failure:(data) => {
			console.log(data);
		}
	})
});

$(proteine).change(function(event){
		if($(this).prop("checked")){
		proteineChoix = event.target.attributes.id.value;
		}
		$.ajax({
			url:"http://localhost/projet-Pro/global/content/pouet2.php",
			method:"POST",
			data:{
				"proteine":proteineChoix
			},
			success:(data)=>{	
				console.log(data);
				if(data == "OK"){
					console.log(proteineChoix);
				}
			},
			failure:(data) => {
				console.log(data);
			}
		})
});

$(legume).change(function(event){
	legumeChoix = event.target.attributes.id.value;
	let actionLegume = "unchecked";
	if ($(this).prop("checked") == true) {
		actionLegume = "checked";
	}
	$.ajax({
		url:"http://localhost/projet-Pro/global/content/pouet.php",
		method:"POST",
		data:{
			'actionLegume': actionLegume,
			'legume' : legumeChoix
		},
		success:(data) => {
			console.log(data);
			if(data == "OK"){
				console.log(legumeChoix);
			}
		},
		failure:(data) => {
			console.log(data);
		}	
	});
});









	// Autre façon de faire pour récupérer les éléments

	// function clicksurfemme(event) {
	// 	console.log(event);
	// 	choices['genre'] = 'femme';
	// }

	// function clicksurhomme() {
	// 	choices['genre'] = 'homme';
	// }

	// function clicksur2030() {
	// 	choices['age'] = '2030';
	// }

	// function clicksur3040() {
	// 	choices['age'] = '3040';
	// }

	// function clicksur4050() {
	// 	choices['age'] = '4050';
	// }

	// $("#img-femme").click(clicksurfemme);
	// $("#img-homme").click(clicksurhomme);
	// $("#img-2030").click(clicksur2030);
	// $("#img-3040").click(clicksur3040);
	// $("#img-4050").click(clicksur4050);

	// Partie pour le formulaire perso //

	// Je crée un objet nommé choix
	var choix = {};


	function clickOnGenre(event){
		// event.target fait référence a l'img choix genre cliqué dont je vais récupérer la valeur de l'id
		// la propriété genre de l'objet choix (tableau assiociatif) sera donc la valeur de l'id récupéré.
		choix['genre'] = event.target.attributes.id.value
	}

	function clickOnAge(event){
		choix['age'] = event.target.attributes.id.value;
	}

	function clickOnObj(event) {
		choix['obj'] = event.target.attributes.id.value;
	}

	function clickOnHab(event) {
		choix['habitude'] = event.target.attributes.id.value;
	}

	// Au clique je récupérerait la valeur de l'id grace a la fonction liée au click
	$(".img-choix").click(clickOnGenre);
	$(".img-age").click(clickOnAge)
	$(".img-obj").click(clickOnObj);
	$(".img-habitude").click(clickOnHab);




	$(".next").click(function(){
		if(animating) return false;
		animating = true;

		if(poke == 0){
			if(!$(".img-choix").hasClass("selected")){
				$(".img-choix").css("filter","grayscale(1)");
			}
			poke = 1;
		}
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
			'transform': 'scale('+scale+')',
			'position': 'absolute'
		});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

// Soumission du formulaire pour le pop-up choix

	// a la soumission du formulaire
	$(".submit").click(function(){
		console.log(choix);
		// je converti mon objet choix en json, avec json.stringify et je le stock dans ma variable mydata
		let mydata = JSON.stringify(choix);
		console.log(mydata);
		// j'appelle la fonction ajax
		$.ajax({
			//on demande au serveur d'aller récupérér les données dans la page pascal.php
			url: 'http://localhost/projet-Pro/global/content/infosperso.php',
			// on utilise la méthode post
			method: 'POST',
			// grace a l'argument data on passe notre tableau assiocatif a php
			data: {
				'json': mydata
			},
			// Après avoir fait son boulot, le serveur nous renvois des infos
			// Si l'appel ajax a réussi on utilise success
			// succes contient data qui contient les données que jquery envoie au code serveur
			success: (data) => {
				console.log(data);
				// si la page dans laquel le serveur a récupéré les données renvoie ok
				if (data == 'OK') {
					// on affiche ...
					console.log('les preferences ....');
				}
			},
			// si la page a rencontré une erreur, failure agit a l'inverse de success et nous affichera les erreurs
			failure: (data) => {
				console.log(data);
			}
		});
		return false;
	})

	$(".img-choix").click(function(e){
		e.preventDefault();
		$('#next1').removeAttr('disabled');
		$(".img-choix").removeClass("selected");
		$(".img-choix").css("filter","grayscale(1)");
		$(this).toggleClass('selected');
		$(this).css("filter","drop-shadow(2px 4px 6px black");
	});

	if(!$(".img-choix").hasClass("selected")){
		$("#next1").prop( "disabled", true );
	}

	$(".img-age").click(function(e){
		e.preventDefault();	
		$('#next2').removeAttr('disabled');
		$(".img-age").removeClass("selected");
		$(".img-age").css("filter","grayscale(1)");
		$(this).toggleClass('selected');
		$(this).css("filter","drop-shadow(2px 4px 6px black");
	});

	if(!$(".img-age").hasClass("selected")){
		$("#next2").prop( "disabled", true );
	}

	$(".img-obj").click(function(e){
		e.preventDefault();	
		$('#next3').removeAttr('disabled');
		$(".img-obj").removeClass("selected");
		$(".img-obj").css("filter","grayscale(1)");
		$(this).toggleClass('selected');
		$(this).css("filter","drop-shadow(2px 4px 6px black");
	});

	if(!$(".img-obj").hasClass("selected")){
		$("#next3").prop( "disabled", true );
	}

	$(".img-habitude").click(function(e){
		e.preventDefault();	
		$('.submit').removeAttr('disabled');
		$(".img-habitude").removeClass("selected");
		$(".img-habitude").css("filter","grayscale(1)");
		$(this).toggleClass('selected');
		$(this).css("filter","drop-shadow(2px 4px 6px black");
	});

	if(!$(".img-habitude").hasClass("selected")){
		$(".submit").prop( "disabled", true );
	}
	

	// $('.-liens-choix-genre').click(function(event){ 
	// 	$(".formulaire-perso").load('index.php');  
	// });
	
	$(".addPanier").click(function(e){
		e.preventDefault();
		$.get($(this).attr("href"),{},function(data){
			if(data.error){
				console.log("error");

				//alert(data.message);
			} else {
				// if(confirm(data.message + ". Voulez vous consulter votre panier ?")){
				location.href = "plats.php";
				// } else {
				// 	$("#total").empty().append(data.total);
				// 	$("#count").empty().append(data.count);
				// }
			}
		},"json");
		return false;
	});


	// $.fn.dropdown = function(options) {
	// var defaults = {};
	// var opts = $.extend(defaults, options);
	// // Apply class=hasSub on those items with children
	// this.each(function() {
	// 	$(this)
	// 	.find("li")
	// 	.each(function() {
	// 		if ($(this).find("ul").length > 0) {
	// 		$(this).addClass("hasSub");
	// 		}
	// 	});
	// });
	// return this;
	// };
	// // ------------------------------------------------
	// // MENU MAIN
	// $(function() {
	// var navMainId = "#navMain";
	// // -------------------
	// // Calling the jquery dropdown
	// $(navMainId).dropdown();
	// // -------------------
	// //Sous-Menu ouvert par defaut
	// $(navMainId + " ul > li.active").addClass("open");
	// $(navMainId + " ul > li.active > ul").slideDown("fast");
	// // -------------------
	// // ouverture/fermeture sous-menu (click/touch)
	// $(navMainId + " ul > li").on("click", function(event) {
	// 	event.stopPropagation(); /* important */
	// 	$(this)
	// 	.parent()
	// 	.find("li:not(:hover)")
	// 	.removeClass("open");
	// 	$(this).toggleClass("open");
	// 	$(this)
	// 	.parent()
	// 	.find("li:not(:hover) ul")
	// 	.slideUp("fast");
	// 	if ($(this).hasClass("hasSub")) {
	// 	$(this)
	// 		.children("ul")
	// 		.slideToggle("fast");
	// 	}
	// });
	// // -------------------
	// // on désactive les liens des Menus AVEC Sous-Menus (obligatoire pour Tablettes TACTILES / Smartphones)
	// $(navMainId + " > ul > li.hasSub > a").on("click", function(event) {
	// 	event.preventDefault();
	// });
	// // -------------------
	// });

	// // ------------------------------------------------
	// // Scrollbar si menu plus grand que la hauteur de fenêtre
	// $(window).on("load resize", function() {
	// var navMainId = "#navMain";
	// //	$(navMainId).height( Math.min( $(window).height(), $(navMainId).height() ) ); //  A ADAPTER par rapport à la hauteur effectivement disponible : hors header, footer,....
	// //  $(navMainId).css({ "overflow-y": "auto" });
	// });
	// // ------------------------------------------------
	// $(document).on("click",function() {
	// 	$("#navMain ul > li.open")
	// 		.removeClass("open")
	// 		.children("ul")
	// 			.slideUp("fast")
	// });


	$(formPerso).click(function(){
		$("#formulaire-perso").css("display","none");
		$("#main").css("backgroundImage","none");
		$("#carouselExampleControls").css("display","block");
		$("#main").addClass("main");
		$(".slider-container").css("display","block");
	});



	const body = document.body;
	const slides = document.querySelectorAll(".slide");
	const leftButton = document.getElementById("left");
	const rightButton = document.getElementById("right");

	let activeSlide = 0;

	const setBackground = () => {
	body.style.backgroundImage = slides[activeSlide].style.backgroundImage;
	};

	const setActiveSlide = () => {
	slides.forEach((slide) => slide.classList.remove("active"));
	slides[activeSlide].classList.add("active");
	};

	// rightButton.addEventListener("click", () => {
	// activeSlide++;
	// if (activeSlide > slides.length - 1) activeSlide = 0;
	// setBackground();
	// setActiveSlide();
	// });

	// leftButton.addEventListener("click", () => {
	// activeSlide--;
	// if (activeSlide < 0) activeSlide = slides.length - 1;
	// setBackground();
	// setActiveSlide();
	// });

	// setBackground();


	
	

	
});