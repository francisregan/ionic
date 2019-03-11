<html>
    <head>
        <title>Lesson</title>
        <link href="css/style.css" rel="stylesheet">
        <script>
            $(document).ready(function(){
                if (window.location.href.indexOf("id") > -1) {
                var params = window.location.search.split('?')[1].split('&');
                var lessonid = decodeURIComponent(params[0].split('=')[1]);
                    $.ajax({ 
                    type: 'GET',
                    url: "viewcontents?id="+lessonid,
                    success: function(data){
                        var viewLessons = JSON.parse(data);
                        var contents = document.getElementById("content");
                        var contentHolder = document.createElement("div");
                        contentHolder.setAttribute("style","padding: 60px;");
                        contentHolder.setAttribute("class","content-holder");
                        contents.appendChild(contentHolder);
                        for (var i =0; i< viewLessons.length; i++){
                        var obj = viewLessons[i];
                        console.log(obj);
                        var createPage = document.createElement("div");
                        var pageHead = document.createElement("div");
                        createPage.setAttribute("style","border: 1px solid powderblue; padding: 60px;");
                        if(i==0){
                            createPage.setAttribute("class","vote-result first selectedDiv");
                        }else if(i==viewLessons.length-1){
                            createPage.setAttribute("class","vote-result last");
                        }else{
                            createPage.setAttribute("class","vote-result");
                        }
                        createPage.setAttribute("name","Page"+(i+1));
                        createPage.setAttribute("id",obj.id);
                        pageHead.setAttribute("id",obj.page_no);

                        createPage.appendChild(pageHead);
                        contentHolder.appendChild(createPage);
                        
                        document.getElementById(obj.id).innerHTML += obj.content;
                        document.getElementById(obj.page_no).innerHTML = "<h3>"+obj.lesson_name+"</h3>"+obj.page_no+"/"+viewLessons.length;
                        }
                        var buttons = document.getElementById("previousContinuous");
                        contentHolder.appendChild(buttons);
                    },
                    error:function(error){
                        console.log(error);
                    }});
                    $(".back-btn").click(function(){debugger;
                        var prevElement=$('.selectedDiv').prev();
                        prevElement.show();
                        $(".selectedDiv").hide();                         
                        $(".selectedDiv").removeClass("selectedDiv");
                        prevElement.addClass("selectedDiv");                            

                        if($('.first').css('display')=="block"){
                            $(".back-btn").addClass("off");
                        }
                        else{
                            $(".next-btn").removeClass("off");  
                        }
                    });

                    $(".next-btn").click(function(){debugger;
                        var nextElement= $('.selectedDiv').next();
                        nextElement.show();
                        $(".selectedDiv").hide();                         
                        $(".selectedDiv").removeClass("selectedDiv");
                        nextElement.addClass("selectedDiv");
                        if($('.last').css('display')=="block"){
                        $(".next-btn").addClass("off");
                        }
                        else{
                            $(".back-btn").removeClass("off");  
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
    <div id="pagehead"></div>
    <div class="field" id="content">

    </div>
        <div class="ui grid" id = "previousContinuous">
            <div class="four column row">
                <div class="left floated column">
                    <a class="back-btn off"><i class="fas fa-arrow-left"></i> Previous</a>
                </div>
                <div class="right floated column">
                    <a class="next-btn">Contitue <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        <div> 
    </body>
</html>