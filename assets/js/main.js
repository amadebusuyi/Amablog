$(function() {
  "use strict";

  function extractContent(s, space) {
    var span= document.createElement('span');
    span.innerHTML= s;
    if(space) {
      var children= span.querySelectorAll('*');
      for(var i = 0 ; i < children.length ; i++) {
        if(children[i].textContent)
          children[i].textContent+= ' ';
        else
          children[i].innerText+= ' ';
      }
    }
    return [span.textContent || span.innerText].toString().replace(/ +/g,' ');
  };


    var clipText = ($el = false, $count = 50) => {
        if(!$el){
             return "Some text...";
        }
        let countCheck = 0;
        let elem = $el.split(" ");
        let text = ""; let exit = "false"; let val = "";
        for(var i = 0; i < elem.length; i++){
            if(elem.length === 1){
                for(var a = 0; a < elem[i].length; a++){
                    if($count === 0 || a === (elem[i].length - 1)){exit = "trueCase1";break;}
                    val += elem[i][a]; $count--; countCheck++;
                }
            }
            else{
                for(var a = 0; a < elem[i].length; a++){
                    if($count === 1 && a < (elem[i].length - 1)){exit = "true";break;}

                    else if($count === 1 && a === (elem[i].length -1)){exit = "truePlus";}

                    else if(($el.length - 1) === (countCheck + elem.length)){exit = "truePlus"; break;}
                    else{$count--; countCheck++;}
                }
            }
            if(exit === "false"){text += elem[i] + " ";}
            else if(exit === "truePlus"){text += elem[i];break;}
            else if(exit === "trueCase1"){text = val;break;}
            else{break;}
        }

        if((countCheck + elem.length + 1) < $el.length){text = text.trim();text += "...";}
        else{text = text.trim();}

        return text;
    }

    var makeSlug = (str) => {
        var slug = str.toLowerCase().replace(/ /g, "-")+"-"+Kato_makeRand(6, "sm-lt-num");
        return slug;
    }

    var nav_offset_top = $('header').height() + 50; 
    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/
    function navbarFixed(){
        if ( $('.header_area').length ){ 
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();   
                if (scroll >= nav_offset_top ) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    
    navbarFixed();

    $("#blog-post").summernote({
        placeholder: "Add blog post here...",
        height: 300, 
    });

    $("#createPost").click(function(e){
        e.preventDefault();
        var title = $("#title").val();
        var category = $("#category").val();
        var image = $("#image-link").val();
        var post = $("#blog-post").summernote("code");
        var summary = clipText(extractContent(post), 200);

        if(title.length < 5){
            $("#title").focus();
            return false;
        }

        else if(category.length < 5){
            $("#category").focus();
            return false;
        }

        else if(image.length < 10){
            $("#image-link").focus();
            return false;
        }

        else if(summary.length < 50){
            notifier.show('Hey!', 'Post cannot be less than 50 characters', 'danger', '', 5000);
            return false;
        }

        var slug = makeSlug(title);

        console.log(slug);

        $.post("controllers/blog/blog.php", {
            create_post: true,
            title: title,
            slug: slug,
            category: category,
            summary: summary,
            image: image,
            post: post
        }, 
        function(data){
            data = JSON.parse(data);
            if(data.status === "success"){
                notifier.show('Amazing!', title+' added to blog posts', 'info', '', 5000);
                $("#title").val("");
                $("#image-link").val("");
                $("#blog-post").summernote("code", "");
            }
            else{
                notifier.show('An error occured!', data.message, 'danger', '', 5000);
            }
        })
    })


    $("#updatePost").click(function(e){
        e.preventDefault();
        var title = $("#title").val();
        var category = $("#category").val();
        var image = $("#image-link").val();
        var post = $("#blog-post").summernote("code");
        var summary = clipText(extractContent(post), 200);
        var slug = $(".slug").text();
        console.log(slug);

        if(title.length < 5){
            $("#title").focus();
            return false;
        }

        else if(category.length < 5){
            $("#category").focus();
            return false;
        }

        else if(image.length < 10){
            $("#image-link").focus();
            return false;
        }

        else if(summary.length < 50){
            notifier.show('Hey!', 'Post cannot be less than 50 characters', 'danger', '', 5000);
            return false;
        }

        $.post("../controllers/blog/blog.php", {
            update_post: true,
            slug: slug,
            title: title,
            category: category,
            summary: summary,
            image: image,
            post: post
        }, 
        function(data){
            data = JSON.parse(data);
            if(data.status === "success"){
                notifier.show('Amazing!', title+' updated', 'info', '', 5000);
            }
            else{
                notifier.show('An error occured!', data.message, 'danger', '', 5000);
            }
        })
    })

    $(".display-time").each(function(){
        $(this).text(formatTime($(this).text()));
    })

    $("#postComment").click(function(e){
        e.preventDefault();
        var comment = $("#comment").val();
        var post = $("#post-id").text();
        if(comment.length < 3){
            $("#comment").focus();
            return false;
        }
        else{
            $.get("../controllers/blog/blog.php?post_comment="+comment+"&post="+post, function(data){
                data = JSON.parse(data);
                if(data.status === "success"){
                    location.reload();
                }
                else{
                    notifier.show('An error occured!', data.message, 'danger', '', 5000);
                }
            })
        }
    })
});


