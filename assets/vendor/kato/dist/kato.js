    var Kato_makeRand = (length, type = false) => {
        var result = '';
        characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if(type == "cap-lt-num"){characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';}
        else if(type == "all"){characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';}
        else if(type == "sm-lt-num"){characters = 'abcdefghijklmnopqrstuvwxyz0123456789';}
        else if(type == "num"){characters = '1234567890';}
        else if(type == "sm-lt"){characters = "abcdefghijklmnopqrstuvwxyz";}

        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
           result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    var Kato_formHandler = (elem, type) => {
        let parent = $(elem).parent("[data-form]");
        let input = $(parent).html();
        $(parent).html("<div class='form-group'>"+input+"</div>");
        let tag = $(parent).find("input");
        if(type === "textarea")
            tag = $(parent).find("textarea");
        if(type === "select")
            tag = $(parent).find("select");

        $(tag).focus(function(e){
            $(this).parent(".form-group").find(".error-note-handler").remove();
        })

        if($(tag).data("form-label")){
            let text = $(tag).data("form-label");
            let placeholder = "";
            if($(tag).data("form-float") !== undefined){
                if($(tag).data("form-placeholder")){
                    placeholder = $(tag).data("form-placeholder");
                    $(tag).prop("placeholder", placeholder);
                }
                else{
                    $(tag).prop("placeholder", text);    
                }

                $(tag).focus(function(){         
                    // if($(tag).data("form-required") !== undefined || $(tag).prop("required") !== false && ){
                    //     text = text+"<span style='color: brown'> *</span>";
                    // }
                    $(tag).parent(".form-group").prepend(`<inputname style="position: absolute; margin-top: -10px; font-size: 14px; background: white; padding: 0 3px; margin-left: 7px; color: #767">${text}</inputname>`);
                    if(placeholder && $(tag).val().length < 1){
                        $(tag).prop("placeholder", placeholder);
                    }
                })

                $(tag).focusout(function(){
                    if(text.indexOf("<span") > -1){
                        text = text.split("<span")[0];
                    }
                    if($(tag).val() == null || $(tag).val().length < 1){
                        // $(tag).prop("placeholder", text);
                        $(tag).parent(".form-group").children("inputname").remove();
                    }
                })
            }
            else{
                if($(tag).data("form-placeholder")){
                    placeholder = $(tag).data("form-placeholder");
                    $(tag).prop("placeholder", placeholder);
                }
                else
                    $(tag).prop("placeholder", text);

                let rand = Kato_makeRand(15, "all");
                let id = $(tag).prop("id");
                if(!id){
                    $(tag).prop("id", rand);
                    id = rand;
                }
                // if($(tag).data("form-required") !== undefined || $(tag).prop("required") !== false){
                //     text = text+"<span style='color: brown'> *</span>";
                // }
                $(tag).parent(".form-group").prepend(`<label for="${id}">${text}</label>`); 
            }
        }
    }

    $("input").each(function(){
        Kato_formHandler(this);
    })

    $("textarea").each(function(){
        Kato_formHandler(this, "textarea");
    })

    $("select").each(function(){
        Kato_formHandler(this, "select");
    })

    var Kato_formValidate = (tag, type="json") => {
        let status = 1;
        let result = {};
        if(type == "form"){
            result = "";
        }

        var load = (elem) => {

            let id = elem.prop("id");
            let val = elem.val();
            if((elem).data("form-currency") !== undefined){
                let curr = elem.data("form-currency");
                if(curr !== ""){
                    val.replace(curr, "");
                }
                val = val.replace("₦", "");
                val = val.replace("$", "");
            }

            if(id.indexOf("-") > -1){
                id = id.replace(/-/g, "_");
            }

            if(type == "json"){
                result[id] = val;
            }

            else if(type == "form"){
                result += "&"+id+"="+val;
            }

        }

        $(tag).find(".form-control").each(function(){
            if($(this).data("form-required") != undefined || $(this).prop("required") != false){

                if($(this).val() == null || $(this).val().length < 1){
                    status = 0;
                    let warning = "This is a required field";
                    if($(this).data("form-required").length > 0){
                        warning = $(this).data("form-required");
                    }
                    else if($(this).prop("required").length > 0){
                        warning = $(this).prop("required");
                    }
                    let errCheck = $(this).parent(".form-group").find(".error-note-handler").html();
                    if(!errCheck)
                        $(this).parent(".form-group").append("<span class='error-note-handler' style='color: brown; font-size: 12px; margin-top: 5px; position: relative'>"+warning+"</span>")
                    
                }

                load($(this));
            }

            else{
                load($(this));
            }
        })

        if(status == 0)
            return {status: "failed", message: "required field empty", data: result};
        
        else
            return {status: "success", message: "Form complete", data: result};
    }

    function Kato_numOnly(e, append = false){
        let ins = e.key;
        let state = false;
        let numray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0, ".", ","];
        if(append){
            $.each(append, (i, item) => {
                numray.push(item.trim());
            })
        }

        for(var i = 0; i < numray.length; i++){
            if(ins == String(numray[i])){
                state = true;
                break;
            }
            else{}
        } 
        if(state === false){
            //alert(100);
            e.preventDefault();
        } 
    }


    function Kato_moneyToNum(str, curr=""){
        let reg = new RegExp(curr, "g");
        str = str.replace(reg, "");
        str = str.replace(/₦/g, "");
        str = str.replace("$", "");
        str = Number(str.replace(/,/g, ""));
        return str;
    }


    function Kato_moneyToFixed(str, curr=""){
          let reg = new RegExp(curr, "g");
          str = str.replace(reg, "");
          str = str.replace(/₦/g, "");
          str = str.replace("$", "");
          str = Number(str.replace(/,/g, "")).toFixed(2);
          return str;
    }


    function Kato_formatMoney(amount, curr = "₦"){
        let reg = new RegExp(curr, "g");
        amount = amount.replace(reg, "");
        amount = amount.replace("#", "");
        amount = amount.replace("$", "");
        amount = amount.replace("£", "");
        amount = amount.replace("€", "");
        amount = Number(amount.replace(/,/g, "")).toFixed(2);
        amount = amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        return curr+amount;
    }


    function Kato_formatCrypto(amount, curr = ""){
        let reg = new RegExp(curr, "g");
        amount = amount.replace(reg, "");
        amount = amount.replace("#", "");
        amount = amount.replace("$", "");
        amount = amount.replace("£", "");
        amount = amount.replace("€", "");
        amount = Number(amount.replace(/,/g, "")).toFixed(4);
        amount = amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1");
        return curr+amount;
    }

    $("[data-form-num]").keypress(function(e){
        Kato_numOnly(e);
    })

    $("[data_form_num]").keypress(function(e){
        Kato_numOnly(e);
    })

    $("[data-form-currency]").keypress(function(e){
        let curr = $(this).data("form-currency");
        if($(this).val().length > 10)
            return false;
        curr = curr.split(",");
        if(curr)
            Kato_numOnly(e, curr);
        else
            Kato_numOnly(e);
    })

    $("[data-form-currency]").change(function(){
        let currInfo = $(this).data("form-currency");
        currInfo = currInfo.split(",");
        if(currInfo[1] && currInfo[1].trim() == "crypto"){
            if(currInfo[0])
                $(this).val(Kato_formatCrypto($(this).val(), currInfo[0].trim()));
            else
                $(this).val(Kato_formatCrypto($(this).val()));
        }
        else{
            if(currInfo[0])
                $(this).val(Kato_formatMoney($(this).val(), currInfo[0].trim()));
            else
                $(this).val(Kato_formatMoney($(this).val()));
        }
    })
    

    var clipText = ($el = false, $count = 50) => {
    if(!$el){
        return "Some text...";
    }
    let countCheck = 0;
    let elem = $el.split(" ");
    let text = ""; exit = "false"; val = "";
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

var inputArr = [];

var nextLoc = (input, next) => {
    $.each(inputArr, (i, item)=>{
        if(item === input){
            if(i > -1 && i < 6){
                $("#"+inputArr[i+next]).focus();
            }
        }
    })
}

$("[data-form-code]").find("input").each(function(){
    let input = $(this).attr("id");
    if(!input){
        input = Kato_makeRand(16);
        $(this).attr("id", input);
    }
    inputArr.push(input);

    $(this).keyup(function(e){
        if(e.keyCode == 8){
            $("#"+input).val("");
            nextLoc(input, -1);
        }
        else if(e.keyCode == 46){
            e.preventDefault();
            $("#"+input).val("");
            nextLoc(input, 1);
        }
        else if(e.keyCode == 37){
            e.preventDefault();
            nextLoc(input, -1);
        }
        else if(e.keyCode == 39){
            e.preventDefault();
            nextLoc(input, 1);
        }
        else if($(this).val().length){
            nextLoc(input, 1);      
        }
    })

    $(this).keypress(function(e){
    let numArr = [0,1,2,3,4,5,6,7,8,9];
        let numState = false;
        $.each(numArr, (i, num)=>{
            if(num == e.key)
                numState = true;
        });

        if(!numState){
            e.preventDefault();
            return false;
        }
    })
});

var Kato_validateEmail = (mail) => {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        return true;
    else
        return false;
};

var Kato_validatePhone = (phone) => {
 if(phone.match(/^\d{13}$/))
     return true;
 else
     return false;
};


var Kato_validatePassword = (pwd) => {
    if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@($!%*?&]{8,}$/.test(pwd))
        return true;
    else
        return false;
};

