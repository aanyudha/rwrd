function setAjaxData(object = null) {
    var data = {
        'sysLangId': TrConfig.sysLangId,
    };
    data[TrConfig.csrfTokenName] = $('meta[name="X-CSRF-TOKEN"]').attr('content');
    if (object != null) {
        Object.assign(data, object);
    }
    return data;
}

function setSerializedData(serializedData) {
    serializedData.push({name: 'sysLangId', value: TrConfig.sysLangId});
    serializedData.push({name: TrConfig.csrfTokenName, value: $('meta[name="X-CSRF-TOKEN"]').attr('content')});
    return serializedData;
}

// Passive event listeners
jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
//validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})();

//tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

//lazyload background images
document.addEventListener('lazybeforeunveil', function (e) {
    var bg = e.target.getAttribute('data-bg');
    if (bg) {
        e.target.style.backgroundImage = 'url(' + bg + ')';
    }
});

//mobile memu
$(document).on('click', '.mobile-menu-button', function () {
    if ($("#navMobile").hasClass('nav-mobile-open')) {
        $("#navMobile").removeClass('nav-mobile-open');
        $('#overlay_bg').hide();
    } else {
        $("#navMobile").addClass('nav-mobile-open');
        $('#overlay_bg').show();
    }
});
$(document).on('click', '#overlay_bg', function () {
    $("#navMobile").removeClass('nav-mobile-open');
    $('#overlay_bg').hide();
});
//close menu
$('.close-menu-click').click(function () {
    $('#navMobile').removeClass('nav-mobile-open');
    $('#overlay_bg').hide();
});

$(document).ready(function () {
    $('form.needs-validation').attr('novalidate', 'novalidate');
    $(".show-on-page-load").css("visibility", "visible");

    $('.nav-main .nav-item-category').hover(function () {
        var categoryId = $(this).attr('data-category-id');
        $('.mega-menu').css('display', 'none');
        $('.mega-menu .link-sub-category').removeClass('active');
        $('.mega-menu .menu-category-items').removeClass('active');
        $('.mega-menu .link-sub-category-all').addClass('active');
        $('.mega-menu .menu-right .filter-all').addClass('active');
        $('.mega-menu-' + categoryId).css('display', 'flex');
    }, function () {
        $('.mega-menu').css('display', 'none');
    });
    $('.mega-menu').hover(function () {
        $(this).css('display', 'flex');
        var categoryId = $(this).attr('data-category-id');
        $('.nav-main .nav-item-category-' + categoryId).addClass('active');
    }, function () {
        $('.mega-menu').css('display', 'none');
        $('.nav-main .nav-item-category').removeClass('active');
    });
    $('.mega-menu .link-sub-category').hover(function () {
        var filter = $(this).attr('data-category-filter');
        $('.mega-menu .link-sub-category').removeClass('active');
        $(this).addClass('active');
        $('.mega-menu .menu-category-items').removeClass('active');
        $('.mega-menu .menu-right .filter-' + filter).addClass('active');
    }, function () {
    });

    $('.mobile-search-button').click(function () {
        $('.mobile-search-form').slideToggle(300);
    });

    //main slider
    $('#main-slider').slick({
        autoplay: true,
        autoplaySpeed: 4900,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 200,
        rtl: TrConfig.rtl,
        cssEase: 'linear',
        lazyLoad: 'progressive',
        prevArrow: $('#main-slider-nav .prev'),
        nextArrow: $('#main-slider-nav .next'),
    });

    $('#post-detail-slider').slick({
        autoplay: false,
        autoplaySpeed: 4900,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        speed: 200,
        rtl: TrConfig.rtl,
        adaptiveHeight: true,
        lazyLoad: 'progressive',
        prevArrow: $('#post-detail-slider-nav .prev'),
        nextArrow: $('#post-detail-slider-nav .next'),
    });

    $('.newsticker li').delay(500).fadeIn(100);
    $('.newsticker').newsTicker({
        row_height: 30,
        max_rows: 1,
        speed: 400,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 0,
        prevButton: $('#nav_newsticker .prev'),
        nextButton: $('#nav_newsticker .next')
    });

    if (TrConfig.categorySliderIds.length > 0) {
        for (var i = 0; i < TrConfig.categorySliderIds.length; i++) {
            var sliderId = TrConfig.categorySliderIds[i];
            $('#category_slider_' + sliderId).slick({
                autoplay: true,
                autoplaySpeed: 4900,
                infinite: true,
                speed: 200,
                rtl: TrConfig.rtl,
                cssEase: 'linear',
                prevArrow: $('#category_slider_nav_' + sliderId + ' .prev'),
                nextArrow: $('#category_slider_nav_' + sliderId + ' .next'),
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {breakpoint: 992, settings: {slidesToShow: 3, slidesToScroll: 1}},
                    {breakpoint: 768, settings: {slidesToShow: 2, slidesToScroll: 1}},
                    {breakpoint: 576, settings: {slidesToShow: 1, slidesToScroll: 1}}
                ]
            });
        }
    }
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn()
        } else {
            $('.scrollup').fadeOut()
        }
    });
    $(".scrollup").click(function () {
        $('html, body').animate({scrollTop: 0}, 700);
        return false
    });
});

//search
$(".search-icon").click(function () {
    if ($(".search-form").hasClass("open")) {
        $(".search-form").removeClass("open");
    } else {
        $(".search-form").addClass("open");
    }
});
//login
$(document).ready(function () {
    $("#form-login").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var serializedData = form.serializeArray();
        serializedData = setSerializedData(serializedData);
        $.ajax({
            url: TrConfig.baseURL + '/AuthController/mloginPost',
            type: 'POST',
            data: serializedData,
            success: function (response) {
                var obj = JSON.parse(response);
				//console.log(obj.result);
				// console.log(obj.ngetespwd);
                if (obj.result == 1) {
                    location.reload();
                } else if (obj.result == 0) {
                    document.getElementById("result-login").innerHTML = obj.error_message;
                }
            }
        });
    });

    $(".form-newsletter").submit(function (event) {
        event.preventDefault();
        var formId = $(this).attr('id');
        var input = '#' + formId + " .newsletter-input";
        var email = $(input).val().trim();
        if (email == '') {
            $(input).addClass('has-error');
            return false;
        } else {
            $(input).removeClass('has-error');
        }
        var serializedData = $(this).serializeArray();
        serializedData = setSerializedData(serializedData);
        $.ajax({
            type: 'POST',
            url: TrConfig.baseURL + '/add-newsletter-post',
            data: serializedData,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    if (formId == 'form_newsletter_footer') {
                        document.getElementById("form_newsletter_response").innerHTML = obj.htmlContent;
                    } else {
                        document.getElementById("modal_newsletter_response").innerHTML = obj.htmlContent;
                    }
                    if (obj.isSuccess == 1) {
                        $(input).val('');
                    }
                }
            }
        });
    });


});

//load more posts
function loadMorePosts() {
    $(".btn-load-more").prop("disabled", true);
    $('.btn-load-more svg').hide();
    $('.btn-load-more .spinner-load-more').show();
    var data = {
        'limit': parseInt($("#limit_load_more_posts").text()),
        'view': '_post_item'
    };
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/loadMorePosts',
        data: setAjaxData(data),
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                setTimeout(function () {
                    $("#last_posts_content").append(obj.htmlContent);
                    $("#limit_load_more_posts").text(obj.newLimit);
                    $(".btn-load-more").prop("disabled", false);
                    $('.btn-load-more svg').show();
                    $('.btn-load-more .spinner-load-more').hide();
                    if (obj.hideButton) {
                        $(".btn-load-more").hide();
                    }
                }, 300);
            } else {
                setTimeout(function () {
                    $(".btn-load-more").hide();
                    $('.btn-load-more svg').show();
                    $('.btn-load-more .spinner-load-more').hide();
                }, 300);
            }
        }
    });
}

//view poll results
function viewPollResults(a) {
    $("#poll_" + a + " .question").hide();
    $("#poll_" + a + " .result").show()
}

//view poll option
function viewPollOptions(a) {
    $("#poll_" + a + " .result").hide();
    $("#poll_" + a + " .question").show()
}

//add reaction
function addReaction(postId, reaction) {
    var data = {
        'post_id': postId,
        'reaction': reaction
    };
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/addReaction',
        data: setAjaxData(data),
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                document.getElementById("reactions_result").innerHTML = obj.htmlContent
            }
        }
    });
}

//vote poll
$(document).ready(function () {
    $(".poll-form").submit(function (event) {
        event.preventDefault();
        var formId = $(this).attr("data-form-id");
        var form = $(this);
        var serializedData = form.serializeArray();
        serializedData = setSerializedData(serializedData);
        $.ajax({
            url: TrConfig.baseURL + '/AjaxController/addPollVote',
            type: 'POST',
            data: serializedData,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    if (obj.htmlContent == 'required') {
                        $("#poll-required-message-" + formId).show();
                        $("#poll-error-message-" + formId).hide();
                    } else if (obj.htmlContent == 'voted') {
                        $("#poll-required-message-" + formId).hide();
                        $("#poll-error-message-" + formId).show();
                    } else {
                        document.getElementById("poll-results-" + formId).innerHTML = obj.htmlContent;
                        $("#poll_" + formId + " .result").show();
                        $("#poll_" + formId + " .question").hide()
                    }
                }
            }
        });
    });

    $("#add_comment").submit(function (event) {
        event.preventDefault();
        var formValues = $(this).serializeArray();
        var data = {};
        var submit = true;
        $(formValues).each(function (i, field) {
            if ($.trim(field.value).length < 1) {
                $("#add_comment [name='" + field.name + "']").addClass("is-invalid");
                submit = false;
            } else {
                $("#add_comment [name='" + field.name + "']").removeClass("is-invalid");
                data[field.name] = field.value;
            }
        });
        data['limit'] = $('#post_comment_limit').val();
        if (TrConfig.isRecaptchaEnabled == true) {
            if (typeof data['g-recaptcha-response'] === 'undefined') {
                $('.g-recaptcha').addClass("is-recaptcha-invalid");
                submit = false;
            } else {
                $('.g-recaptcha').removeClass("is-recaptcha-invalid");
            }
        }
        if (submit == true) {
            $('.g-recaptcha').removeClass("is-recaptcha-invalid");
            $.ajax({
                type: 'POST',
                url: TrConfig.baseURL + '/AjaxController/addCommentPost',
                data: setAjaxData(data),
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.type == 'message') {
                        document.getElementById("message-comment-result").innerHTML = obj.htmlContent;
                    } else {
                        document.getElementById("comment-result").innerHTML = obj.htmlContent;
                    }
                    if (TrConfig.isRecaptchaEnabled == true) {
                        grecaptcha.reset();
                    }
                    $("#add_comment")[0].reset();
                }
            });
        }
    });

    $("#add_comment_registered").submit(function (event) {
        event.preventDefault();
        var formValues = $(this).serializeArray();
        var data = {
            'limit': $('#post_comment_limit').val()
        };
        var submit = true;
        $(formValues).each(function (i, field) {
            if ($.trim(field.value).length < 1) {
                $("#add_comment_registered [name='" + field.name + "']").addClass("is-invalid");
                submit = false;
            } else {
                $("#add_comment_registered [name='" + field.name + "']").removeClass("is-invalid");
                data[field.name] = field.value;
            }
        });
        data['limit'] = $('#post_comment_limit').val();
        if (submit == true) {
            $.ajax({
                type: 'POST',
                url: TrConfig.baseURL + '/AjaxController/addCommentPost',
                data: setAjaxData(data),
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.type == 'message') {
                        document.getElementById("message-comment-result").innerHTML = obj.htmlContent;
                    } else {
                        document.getElementById("comment-result").innerHTML = obj.htmlContent;
                    }
                    $("#add_comment_registered")[0].reset();
                }
            });
        }
    });
});

//add subcomment
$(document).on('click', '.btn-subcomment', function () {
    var commentId = $(this).attr("data-comment-id");
    var data = {};
    data['limit'] = $('#post_comment_limit').val();
    var formId = "#add_subcomment_" + commentId;
    $(formId).ajaxSubmit({
        beforeSubmit: function () {
            var formValues = $("#add_subcomment_" + commentId).serializeArray();
            var submit = true;
            $(formValues).each(function (i, field) {
                if ($.trim(field.value).length < 1) {
                    $(formId + " [name='" + field.name + "']").addClass("is-invalid");
                    submit = false;
                } else {
                    $(formId + " [name='" + field.name + "']").removeClass("is-invalid");
                    data[field.name] = field.value;
                }
            });
            if (TrConfig.isRecaptchaEnabled == true) {
                if (typeof data['g-recaptcha-response'] === 'undefined') {
                    $(formId + ' .g-recaptcha').addClass("is-recaptcha-invalid");
                    submit = false;
                } else {
                    $(formId + ' .g-recaptcha').removeClass("is-recaptcha-invalid");
                }
            }
            if (submit == false) {
                return false;
            }
        },
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/addCommentPost',
        data: setAjaxData(data),
        success: function (response) {
            if (TrConfig.isRecaptchaEnabled == true) {
                grecaptcha.reset();
            }
            var obj = JSON.parse(response);
            if (obj.type == 'message') {
                document.getElementById("message-subcomment-result-" + commentId).innerHTML = obj.htmlContent;
            } else {
                document.getElementById("comment-result").innerHTML = obj.htmlContent;
            }
            $('.visible-sub-comment form').empty();
        }
    })
});

//add registered subcomment
$(document).on('click', '.btn-subcomment-registered', function () {
    var commentId = $(this).attr("data-comment-id");
    var data = {};
    $("#add_subcomment_registered_" + commentId).ajaxSubmit({
        beforeSubmit: function () {
            var form = $("#add_subcomment_registered_" + commentId).serializeArray();
            var comment = $.trim(form[0].value);
            if (comment.length < 1) {
                $(".form-comment-text").addClass("is-invalid");
                return false;
            } else {
                $(".form-comment-text").removeClass("is-invalid");
            }
        },
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/addCommentPost',
        data: setAjaxData(data),
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.type == 'message') {
                document.getElementById("message-subcomment-result-" + commentId).innerHTML = obj.htmlContent;
            } else {
                document.getElementById("comment-result").innerHTML = obj.htmlContent;
            }
            $('.visible-sub-comment form').empty();
        }
    })
});


//show comment box
$(document).on('click', '.comment-meta .btn-reply', function () {
    $('.comment-meta .btn-reply').prop('disabled', true);
    var commentId = $(this).attr('data-parent');
    if ($('#sub_comment_form_' + commentId).html().length > 0) {
        $('#sub_comment_form_' + commentId).empty();
        $('.comment-meta .btn-reply').prop('disabled', false);
    } else {
        $('.visible-sub-comment').empty();
        var limit = parseInt($("#post_comment_limit").val());
        var data = {
            'comment_id': commentId,
            'limit': limit
        };
        $.ajax({
            type: 'POST',
            url: TrConfig.baseURL + '/AjaxController/loadSubcommentBox',
            data: setAjaxData(data),
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.result == 1) {
                    $('#sub_comment_form_' + commentId).append(obj.htmlContent);
                }
                $('.comment-meta .btn-reply').prop('disabled', false);
            }
        });
    }
});

//like comment
$(document).on('click', '.btn-comment-like', function () {
    if ($(this).hasClass('comment-liked')) {
        $(this).removeClass('comment-liked');
    } else {
        $(this).addClass('comment-liked');
    }
    var commentId = $(this).attr("data-comment-id");
    var data = {
        'comment_id': commentId
    };
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/likeCommentPost',
        data: setAjaxData(data),
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                document.getElementById("lbl_comment_like_count_" + commentId).innerHTML = obj.likeCount;
            }
        }
    });
});

//load more comments
function loadMoreComments(postId) {
    var limit = parseInt($("#post_comment_limit").val());
    var data = {
        'post_id': postId,
        'limit': limit
    };
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/loadMoreComments',
        data: setAjaxData(data),
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.result == 1) {
                setTimeout(function () {
                    $("#post_comment_limit").val(limit + 5);
                    document.getElementById("comment-result").innerHTML = obj.htmlContent
                }, 500);
            }
        }
    });
}

//add remove reading list
function addRemoveReadingListItem(postId) {
    $(".tooltip").hide();
    var data = {
        'post_id': postId,
    };
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/AjaxController/addRemoveReadingListItem',
        data: setAjaxData(data),
        success: function (response) {
            location.reload();
        }
    });
}

$(document).on('click', '.btn-load-more', function () {
    $('.btn-load-more svg').hide();
    $('.btn-load-more .spinner-load-more').show();
});

//delete comment
function deleteComment(commentId, postId, message) {
    swal({
        text: message,
        icon: 'warning',
        buttons: [TrConfig.textCancel, TrConfig.textOk],
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var limit = parseInt($("#post_comment_limit").val());
            var data = {
                'id': commentId,
                'post_id': postId,
                'limit': limit
            };
            $.ajax({
                type: 'POST',
                url: TrConfig.baseURL + '/AjaxController/deleteCommentPost',
                data: setAjaxData(data),
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        document.getElementById("comment-result").innerHTML = obj.htmlContent;
                    }
                }
            });
        }
    });
}

//close cookies warning
function closeCookiesWarning() {
    $('.cookies-warning').hide();
    $.ajax({
        type: 'POST',
        url: TrConfig.baseURL + '/close-cookies-warning-post',
        data: setAjaxData({}),
        success: function (response) {
        }
    });
}

//show image preview
function showImagePreview(input, showAsBackground) {
    var divId = $(input).attr('data-img-id');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (showAsBackground) {
                $('#' + divId).css('background-image', 'url(' + e.target.result + ')');
            } else {
                $('#' + divId).attr('src', e.target.result);
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//print
$("#print_post").on("click", function () {
    $(".post-content .post-title, .post-content .post-image, .post-content .post-text").printThis({importCSS: true,})
});

//on ajax stop
$(document).ajaxStop(function () {
    function b(c) {
        $("#poll_" + c + " .question").hide();
        $("#poll_" + c + " .result").show()
    }

    function a(c) {
        $("#poll_" + c + " .result").hide();
        $("#poll_" + c + " .question").show()
    }
});

//cart
// $(document).ready(function(){
            // $('#smartcart').smartCart();
			
// var form = new FormData(document.getElementById("ttt-form"));
				// return new Promise(function (resolve) {
						  // $.ajax({
								// type: 'POST',
								// url: TrConfig.baseURL + '/EarningsController/cobaPost',
								// data: form,
								// dataType: "JSON",
								// contentType: false,       // The content type used when sending data to the server.
								// cache: false,             // To unable request pages to be cached
								// processData:false,
								// success: function(result){
									// console.log(result);
								// }
							// })
							// .done(function (response) {
								// var resToPrint = response;
							  	// console.log("disini sukses ajax_print88");
							  	
							// })
							// .fail(function (erordata, response) {
							  // Swal.fire('Data tidak masuk', 'error');
							// })
				// });
        // });
		
		
		$(document).ready(function(){
            $('#smartcart').smartCart();
			// Event listener untuk get nilai submit
             $('#smartcart').on('cartSubmitted', function(e, cart) {
                console.log('Cart Submitted:', cart);
				// $cart_data = json_decode($cart, true);
				$.ajax({
                type: 'POST',
                url: TrConfig.baseURL + '/EarningsController/cobaPost',
                data: setAjaxData({ cart: JSON.stringify(cart) }),
                success: function (result) {
                    console.log(result);
                }
				});
            });
            // Coba Event listener untuk mengupdate nilai badge saat keranjang diperbarui
			// $('#smartcart').on('itemAdded', function(e, cart) {
				// Ambil jumlah item dari keranjang
				// var itemCount = cart.length;
				// console.log(cart);
				// Perbarui nilai badge
				// $('.sc-cart-count').text(itemCount);
			// });
			// Coba Event listener untuk mengupdate nilai badge saat keranjang diperbarui
			// $('#smartcart').on('itemRemoved', function(e, cart) {
				// console.log(cart);
			// });
			// Coba Event listener untuk mengupdate nilai badge saat keranjang diperbarui
			// $('#smartcart').on('eventName', function(e, cart) {
				// console.log(cart);
			// });
        });

function ajax_print88() {
		var form = new FormData(document.getElementById("ttt-form"));
				return new Promise(function (resolve) {
						  $.ajax({
								type: 'POST',
								url: tntrConfig.baseURL + '/EarningsController/cobaPost',
								data: form,
								dataType: "JSON",
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								processData:false,
								success: function(result){
									console.log(result);
								}
							})
							.done(function (response) {
								var resToPrint = response;
							  	console.log("disini sukses ajax_print88");
							  	
							})
							.fail(function (erordata, response) {
							  Swal.fire('Data tidak masuk', 'error');
							})
				});
}
function detailGift() {
		var idGift = $("#inputNya").val(); 
            var data = {
                'id_Parkir': idGift,
            };
            //addCsrf(data);
            $.ajax({
                type: 'POST',
                url: TrConfig.baseURL + '/EarningController/getDtlGift',
                data: data,
                success: function (response) {
					var obj = JSON.parse(response);
					console.log(obj.stats);
					if(obj.stats == 1){
						if(obj.image_default != null){
						Swal.fire({
						  title: 'Gift Detail',
						  showCancelButton: true,
						  confirmButtonText: ''+TrConfig.textOk+'',
						  cancelButtonText: ''+TrConfig.textCancel+'',
						  html:
							'<div class="input-row mb-2">' +
							'   <div class="col-sm-8">' +
							'		<div class="input-group">'	+
							'		<input type="text" id="swal2-input1" class="form-control form-control-lg" value="'+obj.deskripsi+'" disabled>' +
							'		</div>' +
							'  </div>' +
							'</div>' +
							'<div class="card text-center">' +
							'<img src="' + TrConfig.baseURL+'/'+obj.image_default + '" height="320">' +
							'</div>' +
							'<hr>' +
							'<input type="hidden" id="id_parkirnya" class="form-control form-control-lg" value="'+idGift+'">' +
							'<div class="input-row mb-2">' +
							'  <div class="col-sm-8">' +
							'		<div class="input-group">' +
							'			<input type="text" id="remark_outnya" class="form-control form-control-lg" placeholder="Remarks Out">' +
							'		</div>' +
							'</div>' +
							'</div>',
							showLoaderOnConfirm: true,
							  preConfirm: () => {
								  //var form_data = new FormData($('#formupld')[0]); 
								  var id_parkirnya = $("#id_parkirnya").val();
								  var remark_outnya = $("#remark_outnya").val();
								  var file_data = $("#file").prop("files")[0]; // Getting the properties of file from file field
									var form_data = new FormData();
									 form_data.append("file", file_data)
									 form_data.append("id_parkirnya",id_parkirnya)
									 form_data.append("remark_outnya", remark_outnya)
								return new Promise(function (resolve) {
								  $.ajax({
									type: 'POST',
									url: TrConfig.baseURL + '/HomeController/parkOutPost',
									dataType: "JSON",
									data: form_data,
									contentType: false,       // The content type used when sending data to the server.
									cache: false,             // To unable request pages to be cached
									processData:false,
								})
								  // 
									.done(function (response) {
									  console.log("disini sukses");
									  //var obj2 = JSON.parse(response);
									  //console.log(obj2.id_Parkir);
										Swal.fire('Sukses Park Out');
										$("#inputNya").val("");
									})
									.fail(function (erordata) {
									  console.log(erordata);
									  Swal.fire('cancelled!', 'The action have been cancelled by the user :-)', 'error');
									})
								})
							  },
						  allowOutsideClick: () => !swal.isLoading(),
						  focusConfirm: false,
						}).then((result) => {
							if (result.isConfirmed) {
								
							}
							 if (result.isDismissed) {
								  $("#inputNya").val("");
							  }
							});
						}else { //jika tidak ada gambar dari park in
							Swal.fire({
						  title: 'Kendaraan Keluar',
						  showCancelButton: true,
						  confirmButtonText: ''+TrConfig.textOk+'',
						  cancelButtonText: ''+TrConfig.textCancel+'',
						  html:
							'<div class="input-row mb-2">' +
							'   <div class="col-sm-8">' +
							'		<div class="input-group">'	+
							'		<input type="text" id="swal2-input1" class="form-control form-control-lg" value="'+obj.plat_number+'" disabled>' +
							'		</div>' +
							'  </div>' +
							'</div>' +
							'<!--<div class="input-row mb-2">' +
							'  <div class="col-sm-8">' +
							'		<div class="input-group">' +
							'			<input type="text" id="swal2-input2" class="form-control form-control-lg" value="'+obj.remark+'" disabled>' +
							'		</div>' +
							'</div>' +
							'</div>-->' +
							'<div class="card text-center">' +
							'<p>Foto Tidak Tersedia</p>' +
							'</div>' +
							'<hr>' +
							'<input type="hidden" id="id_parkirnya" class="form-control form-control-lg" value="'+idGift+'">' +
							'<div class="input-row mb-2">' +
							'  <div class="col-sm-8">' +
							'		<div class="input-group">' +
							'			<input type="text" id="remark_outnya" class="form-control form-control-lg" placeholder="Remarks Out">' +
							'		</div>' +
							'</div>' +
							'</div>' +
							'<div class="input-row">' +
							   '<div class="col-sm-5">' +
									'<div class="input-group">' +
										'<p>' +
											'<a class="btn btn-md btn-success btn-file-upload btn-profile-file-upload">' +
												'<input type="file" class="form-control form-control-lg" id="file" name="file" size="40" accept=".png, .jpg, .jpeg"  >' +
											'</a>' +
										'</p>' +
									'</div>' +
								'</div>' +
							'</div>',
							showLoaderOnConfirm: true,
							  preConfirm: () => {
								  //var form_data = new FormData($('#formupld')[0]); 
								  var id_parkirnya = $("#id_parkirnya").val();
								  var remark_outnya = $("#remark_outnya").val();
								  var file_data = $("#file").prop("files")[0]; // Getting the properties of file from file field
									var form_data = new FormData();
									 form_data.append("file", file_data)
									 form_data.append("id_parkirnya",id_parkirnya)
									 form_data.append("remark_outnya", remark_outnya)
								return new Promise(function (resolve) {
								  $.ajax({
									type: 'POST',
									url: TrConfig.baseURL + '/HomeController/parkOutPost',
									dataType: "JSON",
									data: form_data,
									contentType: false,       // The content type used when sending data to the server.
									cache: false,             // To unable request pages to be cached
									processData:false,
								})
								  // 
									.done(function (response) {
									  console.log("disini sukses");
									  //var obj2 = JSON.parse(response);
									  //console.log(obj2.id_Parkir);
										Swal.fire('Sukses Park Out');
										$("#inputNya").val("");
									})
									.fail(function (erordata) {
									  console.log(erordata);
									  Swal.fire('cancelled!', 'The action have been cancelled by the user :-)', 'error');
									})
								})
							  },
						  allowOutsideClick: () => !swal.isLoading(),
						  focusConfirm: false,
						}).then((result) => {
							if (result.isConfirmed) {
								
							}
							 if (result.isDismissed) {
								  $("#inputNya").val("");
							  }
							});
						}
					}else if(obj.stats == 0){
						$("#inputNya").val(""); 
						Swal.fire('Plat Nomor Tersebut Sudah Keluar');
					}
				}
            });
	
	
};