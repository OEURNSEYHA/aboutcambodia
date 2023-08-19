$(document).ready(function () {
    let body = $("body");
    let submenu = $(".sub-menu li");
    let menu = $(".menu li");
    let iconmenubar = $(".icon-menubar i");
    let wrappageright = $(".wrappage-admin-right");
    let wrappageleft = $(".wrappage-admin-left");
    let overlay = $(".overlay");
    let btnadd = $(".btn-add");
    let clickmenubar = 0;
    let optionitem;
    let btnnext = $('.btn-next');
    let btnback = $('.btn-back');
    // let btnsave = $('.btn-save');
    // let btnedit = $('.btn-edit')
    let barcontent = $('.bar-content');
    let categorydata = $('.category-data');
    let tbldata = $('.tbl-data');
    let currentpage = $('#currentpage');
    let indexrow;
    let start = 0;
    let end = $('.optionshow').val();
    let totaldata = $('#totaldata');
    let totalpage = $('#totalpage');
    let iconsearch = $('.icon-search');
    let conditionsearch = 0;
    let valuesearch = $('#valuesearch');
    let filtersearchvalue = $('#filter-search');
    let optionsearch = "";
    let uid = $('#uid').val();
   
    overlay.hide();
    submenu.slideUp();
    barcontent.hide();

    const form = {
        0: "FormUser/FormUser.php",
        1: "FormPermission/FormPermission.php",
        2: "FormMenu/FormMenu.php",
        3: "FormMenuItem/FormMenuItem.php",
        4: "FormSubMenu/FormSubMenu.php",
        5: "FormSubMenuItem/FormSubMenuItem.php",
        6: "FormAds/FormAds.php",
        7: "FormMenu_Submenu/FormMenu_Submenu.php",
    };
    
    let listfilter = [
        {
            "userid":"UserID",
            "userstatus":"UserStatus",
            "username":"UserName",
            "useremail":"UserEmail",
            "usertype":"UserType"
        },
        {
            "id":"ID",
            "userid":"UserID",
            "menuid":"MenuID",
            "actionid":"ActionID"
        },
        {
            "menuid":"MenuID",
            "menutitle":"Title",
            "menuorderid":"OrderID",
            "menustatus":"Status",
            "lang":"Lang",
            "menu_datepost":"Date"
        },
        {
            "mitemid":"ID",
            "mitem_status":"Status",
            "lang":"Lang",
            "mitem_orderid":"OrderID",
            "mitem_title":"Title",
            "mitem_detail":"Detail"
        },
        {
            "submenuid":"ID",
            "submenu_status":"Status",
            "lang":"Lang",
            "submenu_orderid":"OrderID",
            "submenu_title":"Title",
            "submenu_datepost":"Date"

        },
        {
            "smitem_id":"ID",
            "smitem_status":"Status",
            "lang":"Lang",
            "smitem_orderid":"OrderID",
            "smitem_title":"Title",
            "smitem_date":"Date"

        },
        {

            "adsid":"ID",
            "adsstatus":"Status",

        }
    ]

    menu.click(function () {
        let eThis = $(this);
        eThis.find(submenu).slideToggle();
    });

    submenu.click(function () {
        let eThis = $(this);
        start = 0;
        currentpage.text(1);
        optionitem = eThis.data('id');
        barcontent.show();
        categorydata.hide();
        conditionsearch = 0;

        valuesearch.val("");
     
       
        if(optionitem == 0){
            optionsearch = `<option value="0"> FilterSearchUser </option>`;
            for(i in listfilter[optionitem]){
                optionsearch += `<option value="${i}"> ${listfilter[optionitem][i]}</option>`;
                $('#filter-search').html(optionsearch);
            }
            GetDataUser();
        }else if(optionitem == 1){
        
            // alert(listfilter[0][1]);
            optionsearch = `<option value="0"> FilterSearchPermission </option>`;
            for(i in listfilter[optionitem]){
                optionsearch += `<option value="${i}"> ${listfilter[optionitem][i]}</option>`;
                $('#filter-search').html(optionsearch);
            }
            GetDataPermission();

        }else if(optionitem == 2){
            optionsearch = `<option value="0">FilterSearchMenu</option>`;
            for(i in listfilter[optionitem]){
                optionsearch+= `<option value="${i}">${listfilter[optionitem][i]}</option>`;
                $('#filter-search').html(optionsearch);
                
            }
            GetDataMenu();
        }else if(optionitem == 3){
            optionsearch = `<option value="0">FilterSearchMenuItem</option>`;
            for(i in listfilter[optionitem]){
                optionsearch+= `<option value="${i}">${listfilter[optionitem][i]}</option>`;
                $('#filter-search').html(optionsearch);
                
            }
            GetDataMenuItem();
        }
        else if(optionitem == 4){
            optionsearch = `<option value="0">FilterSearchMenuItem</option>`;
            for(i in listfilter[optionitem]){
                optionsearch+= `<option value="${i}">${listfilter[optionitem][i]}</option>`;
                $('#filter-search').html(optionsearch);
                
            }
            GetDataSubMenu();
        }else if(optionitem == 5){
            optionsearch= `<option value="0"> FilterSearchSubMenuItem</option>`;
            for(i in listfilter[optionitem]){

                optionsearch += `<option value="${i}"> ${listfilter[optionitem][i] } </option>`;
                $('#filter-search').html(optionsearch);

            }
            GetDataSubMenuItem();
        }
        else if(optionitem == 6){
            optionsearch= `<option value="0"> FilterSearchSubMenuItem</option>`;
            for(i in listfilter[optionitem]){

                optionsearch += `<option value="${i}"> ${listfilter[optionitem][i] } </option>`;
                $('#filter-search').html(optionsearch);

            }
            GetDataAds();
        }
            // GetDataPermission();
            
        
    });

    iconmenubar.click(function () {
        if (clickmenubar == 0) {
            wrappageright.css({ width: "100%" });
            wrappageleft.css({ position: "fixed", top: "0", "margin-left": "-100%" });
            clickmenubar = 1;
        } else {
            wrappageleft.removeAttr("style");
            wrappageright.removeAttr("style");

            clickmenubar = 0;
        }
    });

    body.on("click", ".btn-close", function () {
        overlay.hide();
    });

    btnadd.click(function () {
    
        overlay.show();
        overlay.load("" + form[optionitem] + "", function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                GetAutoid();
                calleditor();
                $('#userid').val(uid);
                
                $(document).keypress(function(event){
                    let keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        $('.btn-save').click();
                    }
                });
            }
            if (statusTxt == "error") {
                alert("Error" + xhr.status + ":" + xhr.statusTxt);
            }
        }
        );
    });

    // search
    iconsearch.click(function(){
        conditionsearch = 1;
        if(optionitem == 0){
           
            GetDataUser();
        }else if(optionitem == 1){
            GetDataPermission();

        }else if(optionitem == 2){
            GetDataMenu();
        }else if(optionitem == 3){
            GetDataMenuItem();
        }else if(optionitem == 4){
            GetDataSubMenu();
        }else if(optionitem == 5){
            GetDataSubMenuItem();
        }else if(optionitem == 6){
            GetDataAds();
        }
        
    })

    // edit data 
    body.on('click', '.btn-edit', function () {
        let eThis = $(this);
        if(optionitem == 0){
            GetEditUser(eThis);
        }
        else if (optionitem == 1) {
            GetEditPermission(eThis);
        }else if(optionitem == 2){
            GetEditMenu(eThis);

        }else if(optionitem == 3){
            GetEditMenuItem(eThis);
        }else if(optionitem == 4){
            GetEditSubMenu(eThis);
        }else if(optionitem == 5){
            GetEditSubMenuItem(eThis);
        }else if(optionitem == 6){
            
            GetEditAds(eThis);
        }
    })
    // save data user
    const SaveDataUser = (eThis) => {
        let id = $('#id'),
            username = $("#username"),
            useremail = $("#useremail"),
            userpass = $("#userpass"),
            usertype = $('#usertype'),
            userstatus = $('#userstatus'),
            boximg = $('.box-img'),
            imguser = $('#imguser');
        if( username.val()=="" ){
            alert('Please input username');
            useremail.focus();
            return;
        }else if( useremail.val()=="" ){
            alert("Please input useremail");
            username.focus();
            return;
        }else if(userpass.val()==""){
            alert('Please input passwrd');
            userpass.focus();
            return;
        }else if(imguser.val()==""){
            alert("Please Choose File");
            return;
        }
      
        let frm = eThis.closest('form.uploaduser');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"InsertDataToDatabase/InsertDataUser.php",
            type:"POST",
            data:frm_data,
            contentType:false,
            caches: false,
            processData:false,
            dataType: "json",
            beforeSend:function(){
                
            },
            success: function(data){
                
                if(data.dpl == true){
                    alert("Duplicate Email Please Input again");
                }else{
                    if(data.edit == false){
                        let tr = `
                                <tr>
                                    <td>${id.val()}</td>
                                    <td>${username.val()}</td>
                                    <td>${useremail.val()}</td>
                                    <td>${data.userpass}</td>
                                    <td>${usertype.val()}</td>
                                    <td>${data.userip}</td>
                                    <td>${data.codeverify}</td>
                                    <td>${userstatus.val()}</td>
                                    <td><img src="../Admin/Images/${imguser.val()}" alt="${imguser.val()}" width="60" height="40"></td>
                                    <td>${data.userdate}</td>
                                    <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>

                                </tr>
                             `;

                            tbldata.find('tr:eq(0)').after(tr);
                            totaldata.text(parseInt(totaldata.text())+1);
                            id.val(data.autoid + 1);
                            username.val("");
                            useremail.val("");
                            imguser.val("");
                            username.focus();
                            useremail.focus();
                            boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                    }else{
                        body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                        body.find(`tr:eq(${indexrow}) td:eq(1)`).text(username.val());
                        body.find(`tr:eq(${indexrow}) td:eq(2)`).text(useremail.val());
                        body.find(`tr:eq(${indexrow}) td:eq(3)`).text(data.userpass);
                        body.find(`tr:eq(${indexrow}) td:eq(4)`).text(usertype.val());
                        body.find(`tr:eq(${indexrow}) td:eq(5)`).text(data.userip);
                        body.find(`tr:eq(${indexrow}) td:eq(6) `).text(data.codeverify);
                        body.find(`tr:eq(${indexrow}) td:eq(7)`).text(userstatus.val());
                        body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('src','../Admin/Images/'+imguser.val()+'');
                        body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('alt',''+imguser.val()+'');
                        body.find(`tr:eq(${indexrow}) td:eq(9)`).text(data.dateuser);
                        overlay.hide();
                    }
                   
                }
              
            }
        })
    }
    
    // Get data user
    const GetDataUser = () => {
        let th = `
            <tr>
            
                <th>ID</th>
                <th>UserName</th>
                <th>UserEmail</th>
                <th>UserPass</th>
                <th>UserType</th>
                <th>Ip</th>
                <th>Codevery</th>
                <th>Status</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url:"GetDataUser/GetDataUser.php",
            type:"POST",
            data:{
                "start": start,
                "end": end,
                "conditionsearch": conditionsearch,
                "valuesearch":valuesearch.val(),
                "optionsearch":filtersearchvalue.val(),
            },
            caches:false,
            dataType:"json",
            beforeSend: function(){

            },
            success: function(data){
                if(data.length == 0){
                    tbldata.html(th);
                    // totaldata.text(0);
                    // totalpage.text(1);
                    return;
                }
            
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                data.map((item,id)=>{
                      tr += `
                      <tr>
                        <td>${item.userid}</td>
                        <td>${item.username}</td>
                        <td>${item.useremail}</td>
                        <td>${item.userpass}</td>
                        <td>${item.usertype}</td>
                        <td>${item.userip}</td>
                        <td>${item.codeverify}</td>
                        <td>${item.status}</td>
                        <td><img src="../Admin/Images/${item.img}" alt="${item.img}" width="60" height="40"></td>
                        <td>${item.date}</td>
                        <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        
                      </tr>
                        
                    `;
               
                    tbldata.html(th + tr);
                })
                
                

            }


        })
    }

    // Get edit user
    const GetEditUser = (eThis) =>{
        
        let parent = eThis.parents('tr');
        let id = parent.find('td:eq(0)').text(),
            username = parent.find('td:eq(1)').text(),
            useremail = parent.find('td:eq(2)').text(),
            userpass = parent.find('td:eq(3)').text(),
            usertype = parent.find('td:eq(4)').text(),
            userip   = parent.find('td:eq(5)').text(),
            codeverify = parent.find('td:eq(6)').text(),
            userstatus = parent.find('td:eq(7)').text(),
            img = parent.find('td:eq(8) img').attr('alt'),
            userdate = parent.find('td:eq(9)').text();
            indexrow = parent.index();
            
            overlay.show();
            overlay.load("" + form[optionitem] + "", function (responseTxt, statusText) {

                if (statusText == 'success') {
                    body.find('#id').val(id);
                    body.find('#username').val(username);
                    body.find('#useremail').val(useremail);
                    body.find('#userpass').val(userpass);
                    body.find('#usertype').val(usertype);
                    body.find('#userstatus').val(userstatus);
                    body.find('#imguser').val(img);
                    body.find('.box-img').css({'backgroundImage':' url("../Admin/Images/'+img+'")'});
                    body.find('#editid').val(id);
                }
                if (statusText == 'error') {
                    alert('Error' + xhr.status + ':' + xhr.statusText);
                }
            })


    }
    //save data permission
    const SavePermission = (eThis) => {
        let id = $('#id'),
            userid = $('#userid'),
            menuid = $('#menuid'),
            actionid = $('#actionid');
        if (userid.val() == "") {
            alert("Please Input Userid");
            userid.focus();
            return;
        }
        let frm = eThis.closest('form.uploadpermission');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'InsertDataToDatabase/InsertDataPermission.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;

            },
            success: function (data) {
                //work after success;

                if (data.dpl == true) {
                    alert('Please Input UserID again Duplicate UserID!');
                    userid.focus();
                    return;
                }
                if (data.edit == false) {

                    let tr = `
                        <tr>
                            <td>${id.val()}</td>
                            <td>${userid.val()}</td>
                            <td>${menuid.val()}</td>
                            <td>${actionid.val()}</td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            

                        </tr>
                    `;

                    tbldata.find('tr:eq(0)').after(tr);
                    totaldata.text(parseInt(totaldata.text())+1);
                    id.val(data.autoid + 1);
                   
                } else {
                    
                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).text(menuid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(actionid.val());
                    overlay.hide();
                }

            }
        });
    }

    const GetDataPermission = () => {
        
        let th = `
            <tr>
                <th>ID</th>
                <th>UserID</th>
                <th>MenuID</th>
                <th>ActionID</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: 'GetDataPermission/GetDataPermission.php',
            type: 'POST',
            data: { 
                    'start' : start,
                    'end': end,
                    'conditionsearch': conditionsearch,
                    'valuesearch':valuesearch.val(),
                    'optionsearch':filtersearchvalue.val(),
                },
            // contentType: false,
            cache: false,
            // processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;

            },
            success: function (data) {
                //work after success;
                if(data.length == '0'){
                    tbldata.html(th);
                    return;
                }
             
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));

                data.map((item, id) => {
                    tr += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.userid}</td>
                            <td>${item.menuid}</td>
                            <td>${item.actionid}</td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        </tr>
                    `;

                    tbldata.html(th + tr);
                })
            }
        });
    }

    const GetEditPermission = (eThis) => {
        let parent = eThis.parents('tr');
        let id = parent.find('td:eq(0)').text(),
            userid = parent.find('td:eq(1)').text(),
            menuid = parent.find('td:eq(2)').text(),
            actionid = parent.find('td:eq(3)').text();
            indexrow = parent.index();
        alert(indexrow);
        overlay.show();
        overlay.load("" + form[optionitem] + "", function (responseTxt, statusText) {
            if (statusText == 'success') {
                body.find('#id').val(id);
                body.find('#userid').val(userid);
                body.find('#menuid').val(menuid);
                body.find('#actionid').val(actionid);
                body.find('#editid').val(id);
            }
            if (statusText == 'error') {
                alert('Error' + xhr.status + ':' + xhr.statusText);
            }
        })
    }

    const SaveDataMenu = (eThis) => {
        let id = $('#menuid'),
            userid = $('#userid'),
            menutitle = $('#menutitle'),
            menuorderid = $('#menuorderid'),
            menustatus = $('#menustatus'),
            lang = $('#lang'),
            imgmenu = $('#imgmenu');
            boximg = $('.box-img');

            if(menutitle.val()==""){
                alert("Please Input menutitle");
                menutitle.focus();
                return;
            }else if(imgmenu.val()==""){
                alert("Please Choose Image");
                return;
            }
        let frm = eThis.closest('form.uploadmenu');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"InsertDataToDatabase/InsertDataMenu.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            caches: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){

            },
            success: function(data){
                
                if(data.edit == false){
                    let tr = `
                        <tr>
                            <td>${id.val()}</td>
                            <td>${userid.val()}</td>
                            <td>${menutitle.val()}</td>
                            <td>${menuorderid.val()}</td>
                            <td>${menustatus.val()}</td>
                            <td>${lang.val()}</td>
                            <td>${data.date}</td>
                            <td><img src="../Admin/Images/${imgmenu.val()}" alt="${imgmenu.val()}" width="60" height="40"></td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        </tr>
                       
                    `;

                    tbldata.find('tr:eq(0)').after(tr);
                    totaldata.text(parseInt(totaldata.text())+1);
                    id.val(data.autoid + 1);
                    menuorderid.val(data.autoid + 1);
                    menutitle.val("");
                    imgmenu.val("");
                    menutitle.focus();
                    boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});

                }else{
                    
                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).text(menutitle.val());
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(menuorderid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(4)`).text(menustatus.val());
                    body.find(`tr:eq(${indexrow}) td:eq(5)`).text(lang.val());
                    body.find(`tr:eq(${indexrow}) td:eq(6)`).text(data.date);
                    body.find(`tr:eq(${indexrow}) td:eq(7) img`).attr('src','../Admin/Images/'+imgmenu.val()+'');
                    body.find(`tr:eq(${indexrow}) td:eq(7) img`).attr('alt',''+imgmenu.val()+'');
                    overlay.hide();
                }
                    
            }
        })       
    }

    const GetEditMenu = (eThis) =>{

        let parent = eThis.parents('tr');
        let menuid = parent.find('td:eq(0)').text(),
            userid = parent.find('td:eq(1)').text(),
            menutitle = parent.find('td:eq(2)').text(),
            menuorderid = parent.find("td:eq(3)").text(),
            menustatus = parent.find("td:eq(4)").text(),
            lang = parent.find('td:eq(5)').text(),
            imgmenu = parent.find('td:eq(7) img').attr('alt');
            indexrow = parent.index();
        
            overlay.show();
            overlay.load(""+form[optionitem]+"", function(responseTxt, statusText){
            if(statusText == "success"){
                body.find('#menuid').val(menuid);
                body.find('#userid').val(userid);
                body.find('#menutitle').val(menutitle),
                body.find('#menuorderid').val(menuorderid),
                body.find('#menustatus').val(menustatus),
                body.find('#lang').val(lang),
                body.find('#imgmenu').val(imgmenu);
                body.find('.box-img').css({"backgroundImage":"url('../Admin/Images/"+imgmenu+"')"});
                body.find('#editid').val(menuid);
            }
            if(statusText == "error"){

                alert('Error' + xhr.status + ':' + xhr.statusText)
            }
        })
    }

    const GetDataMenu = () =>{
        let th = `
            <tr>
                <th>Id</th>
                <th>UserID</th>
                <th>Title</th>
                <th>OrderID</th>
                <th>Status</th>
                <th>Lang</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: "GetDataMenu/GetDataMenu.php",
            type:"POST",
            data: {
                'start' : start,
                'end': end,
                'conditionsearch': conditionsearch,
                'valuesearch':valuesearch.val(),
                'optionsearch':filtersearchvalue.val(),
            },
            // contentType:false,
            caches: false,
            // processData: false,
            dataType:"json",
            beforeSend:function(){

            },
            success: function(data){
              
                if(data.length == '0'){
                    tbldata.html(th);
                    totaldata.text(0);
                    totalpage.text(1);
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                   data.map((item,id)=>{
                        tr += `
                            <tr>
                                <td>${item.menuid}</td>
                                <td>${item.userid}</td>
                                <td>${item.menutitle}</td>
                                <td>${item.menuorderid}</td>
                                <td>${item.menustatus}</td>
                                <td>${item.lang}</td>
                                <td>${item.menu_datepost}</td>
                                <td><img src="../Admin/Images/${item.menuimg}" alt="${item.menuimg}" width="60" height="40"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                   });
                tbldata.html(th + tr);

                
                
            }
        })
    }


    const SaveDataMenuItem = (eThis) =>{

        let id = $('#mitemid'),
            userid = $('#userid'),
            menuid = $('#menuid'),
            mitem_title = $("#mitem_title"),
            mitem_orderid = $('#mitem_orderid'),
            mitem_status = $('#mitem_status'),
            lang = $('#lang'),
            imgmitem = $("#imgmitem");
            boximg = $('.box-img');
            if(mitem_title.val() == ""){
                alert("Please Input MenuItem title");
                mitem_title.focus();
                return;
            }else if(menuid.val() == 0){
                alert("Please choose Menu ID");
                menuid.focus();
                return;
            }else if(imgmitem.val() == ""){
                alert("please choose img");
                return;
            }

        tinymce.triggerSave();
        let frm = eThis.closest('form.uploadmenuitem');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"InsertDataToDatabase/InsertDataMenuItem.php",
            type:"POST",
            data: frm_data,
            contentType:false,
            caches:false,
            processData:false,
            dataType:"json",
            beforeSend: function(){

            },
            success: function(data){
                
                if(data.edit == false){
                    let tr = `
                        <tr>
                            <td>${id.val()} </td>
                            <td>${userid.val()}</td>
                            <td> <span hidden>${menuid.val()}</span> ${menuid.find('option:selected').text()}</td>
                            <td>${mitem_title.val()}</td>
                            <td>${mitem_orderid.val()}</td>
                            <td>${data.view}</td>
                            <td>${mitem_status.val()}</td>
                            <td>${lang.val()}</td>
                            <td>${data.date}</td>
                            <td><img src="../Admin/Images/${imgmitem.val()}" alt="" width="60" height="40"></td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        </tr>
                    `;
                    tbldata.find('tr:eq(0)').after(tr);
                    mitem_title.val("");
                    mitem_title.focus();
                    mitem_detail.focus();
                    imgmitem.val("");
                    boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                    id.val(data.autoid +1);
                    orderid.val(data.autoid +1);
                   

                }else{

                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).html( `<span hidden>${menuid.val()}</span> ${menuid.find('option:selected').text()}`);
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(mitem_title.val());
                    body.find(`tr:eq(${indexrow}) td:eq(4)`).text(mitem_orderid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(5)`).text(data.view);
                    body.find(`tr:eq(${indexrow}) td:eq(6)`).text(mitem_status.val());
                    body.find(`tr:eq(${indexrow}) td:eq(7)`).text(lang.val());
                    body.find(`tr:eq(${indexrow}) td:eq(8)`).text(data.date);
                    body.find(`tr:eq(${indexrow}) td:eq(9) img`).attr('src','../Admin/Images/'+imgmitem.val()+'');
                    body.find(`tr:eq(${indexrow}) td:eq(9) img`).attr('alt',imgmitem.val());
                    overlay.hide();
                    
                }
               
               
            }
        })
    }
    
    const GetDataMenuItem = () =>{
        let th = `
            <tr>
                <th>Id</th>
                <th>UserID</th>
                <th>MenuID</th>
                <th>Titele</th>
                <th>OrderID</th>
                <th>View</th>
                <th>Status</th>
                <th>Lang</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: "GetDataMenuItem/GetDataMenuItem.php",
            type:"POST",
            data: {
                'start' : start,
                'end': end,
                'conditionsearch': conditionsearch,
                'valuesearch':valuesearch.val(),
                'optionsearch':filtersearchvalue.val(),
            },
            // contentType:false,
            caches: false,
            // processData: false,
            dataType:"json",
            beforeSend:function(){

            },
            success: function(data){
              
                if(data.length == '0'){
                    tbldata.html(th);
                    totaldata.text(0);
                    totalpage.text(1);
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                   data.map((item,id)=>{
                        tr += `
                            <tr>
                                <td>${item.mitemid}</td>
                                <td>${item.userid}</td>
                                <td> <span hidden>${item.menuid}</span> ${item.menutitle} </td>
                                <td>${item.mitem_title}</td>
                                <td>${item.mitem_orderid}</td>
                                <td>${item.mitem_view}</td>
                                <td>${item.mitem_status}</td>

                                <td>${item.lang}</td>
                                <td>${item.mitem_datepost}</td>
                                <td><img src="../Admin/Images/${item.mitem_img}" alt="${item.mitem_img}" width="60" height="40"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                   });
                tbldata.html(th + tr);

                
                
            }
        })
    }

    const GetEditMenuItem = (eThis) =>{
        let parent = eThis.parents('tr');
        let id = parent.find("td:eq(0)").text(),
            userid = parent.find("td:eq(1)").text(),
            menuid = parent.find("td:eq(2) span").text(),
            title = parent.find("td:eq(3)").text(),
            // detail = parent.find("td:eq(4)").text(),
            orderid = parent.find("td:eq(4)").text(),
            status = parent.find("td:eq(6)").text(),
            lang = parent.find("td:eq(7)").text(),
            img = parent.find("td:eq(9) img").attr('alt');
            indexrow = parent.index();
           
        overlay.show();
        overlay.load(""+form[optionitem]+"", function(responseTxt, statusText){
            if(statusText == "success"){

                $.ajax({
                    url:"GetEditMenuItem/GetEditMenuItem.php",
                    type: "POST",
                    data: {"id":id},
                    caches: false,
                    dataType: "json",
                    beforeSend: function(){

                    },
                    success: function(data){
                    body.find("#mitemid").val(id);
                    body.find("#userid").val(userid);
                    body.find("#menuid").val(menuid);
                    body.find("#mitem_title").val(title);
                    body.find("#mitem_detail").val(data.detail);
                    body.find("#mitem_orderid").val(orderid);
                    body.find("#mitem_status").val(status);
                    body.find('#lang').val(lang);
                    body.find('#imgmitem').val(img);
                    body.find('.box-img').css({"backgroundImage":"url('../Admin/Images/"+img+"')"});
                    body.find('#editid').val(id);
                    calleditor();
                    }
                })
                

            }

            if(statusText == "error"){
                alert('Error' + xhr.status + ':' + xhr.statusText)
            }
        })
    }

    
    const SaveDataSubMenu = (eThis) => {
        let id = $('#submenuid'),
            menuid = $('#menuid'),
            userid = $('#userid'),
            title = $('#submenu_title'),
            orderid = $('#submenu_orderid'),
            status = $('#submenu_status'),
            lang = $('#lang'),
            boximg = $(".box-img"),
            imgsubmenu = $('#imgsubmenu');

            if(menuid.val() == 0){
                alert("Please Input MenuID");
                menuid.focus();
                return;
            }
            else if(title.val()==""){
                alert("Please Input menutitle");
                title.focus();
                return;
            }else if(imgsubmenu.val()==""){
                alert("Please Choose Image");
                return;
            }
        let frm = eThis.closest('form.uploadsubmenu');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"InsertDataToDatabase/InsertDataSubMenu.php",
            type: "POST",
            data: frm_data,
            contentType: false,
            caches: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){

            },
            success: function(data){
                if(data.edit == false){
                    let tr = `
                        <tr>
                            <td>${id.val()}</td>
                            <td>${userid.val()}</td>
                            <td> <span hidden>${menuid.val()}</span>${menuid.find("option:selected").text()}</td>
                            <td>${title.val()}</td>
                            <td>${orderid.val()}</td>
                            <td>${status.val()}</td>
                            <td>${lang.val()}</td>
                            <td>${data.date}</td>
                            <td><img src="../Admin/Images/${imgsubmenu.val()}" alt="${imgsubmenu.val()}" width="60" height="40"></td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                        </tr>
                       
                    `;

                    tbldata.find('tr:eq(0)').after(tr);
                    totaldata.text(parseInt(totaldata.text())+1);
                    title.val("");
                    title.focus();
                    imgsubmenu.val("");
                    boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                    id.val(data.autoid + 1);
                    menuorderid.val(data.autoid + 1);
                }
                else{
                    
                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).html(`<span hidden>${menuid.val()}</span>${menuid.find('option:selected').text()}`);
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(title.val());
                    body.find(`tr:eq(${indexrow}) td:eq(4)`).text(orderid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(5)`).text(status.val());
                    body.find(`tr:eq(${indexrow}) td:eq(6)`).text(lang.val());
                    body.find(`tr:eq(${indexrow}) td:eq(7)`).text(data.date);
                    body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('src','../Admin/Images/'+imgsubmenu.val()+'');
                    body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('alt',''+imgsubmenu.val()+'');
                    overlay.hide();
                }
                    
            }
        })       
    }


    const GetDataSubMenu = () =>{
        let th = `
            <tr>
                <th>Id</th>
                <th>UserID</th>
                <th>MenuID</th>
                <th>Titele</th>
                <th>OrderID</th>
                <th>Status</th>
                <th>Lang</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: "GetDataSubMenu/GetDataSubMenu.php",
            type:"POST",
            data: {
                'start' : start,
                'end': end,
                'conditionsearch': conditionsearch,
                'valuesearch':valuesearch.val(),
                'optionsearch':filtersearchvalue.val(),
            },
            // contentType:false,
            caches: false,
            // processData: false,
            dataType:"json",
            beforeSend:function(){

            },
            success: function(data){
              
                if(data.length == '0'){
                    tbldata.html(th);
                    totaldata.text(0);
                    totalpage.text(1);
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                   data.map((item,id)=>{
                        tr += `
                            <tr>
                                <td>${item.submenuid}</td>
                                <td>${item.userid}</td>
                                <td><span hidden>${item.menuid}</span>${item.menutitle}</td>
                                <td>${item.submenu_title}</td>
                                <td>${item.submenu_orderid}</td>
                                <td>${item.submenu_status}</td>

                                <td>${item.lang}</td>
                                <td>${item.submenu_datepost}</td>
                                <td><img src="../Admin/Images/${item.submenu_img}" alt="${item.submenu_img}" width="60" height="40"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                   });
                tbldata.html(th + tr);

            
            }
        })
    }

    const GetEditSubMenu= (eThis) =>{
        let parent = eThis.parents('tr');
        let id = parent.find("td:eq(0)").text(),
            userid = parent.find("td:eq(1)").text(),
            menuid = parent.find("td:eq(2) span").text(),
            title = parent.find("td:eq(3)").text(),
            orderid = parent.find("td:eq(4)").text(),
            status = parent.find("td:eq(5)").text(),
            lang = parent.find("td:eq(6)").text(),
            img = parent.find("td:eq(8) img").attr('alt');
            indexrow = parent.index();
            
        overlay.show();
        overlay.load(""+form[optionitem]+"", function(responseTxt, statusText){
            if(statusText == "success"){

            
                body.find("#submenuid").val(id);
                body.find("#userid").val(userid);
                body.find("#menuid").val(menuid);
                body.find("#submenu_title").val(title);
                body.find("#submenu_orderid").val(orderid);
                body.find("#submenu_status").val(status);
                body.find('#lang').val(lang);
                body.find('#imgsubmenu').val(img);
                body.find('.box-img').css({"backgroundImage":"url('../Admin/Images/"+img+"')"});
                body.find('#editid').val(id);
                
                

            }

            if(statusText == "error"){
                alert('Error' + xhr.status + ':' + xhr.statusText)
            }
        })
    }


    const SaveDataSubMenuItem = (eThis) =>{
        
        let id = $('#smitemid'),
            menuid = $('#menuid'),
            userid = $('#userid'),
            submenuid = $('#submenuid'),
            title = $('#smitem_title'), 
            status = $('#smitem_status'),
            lang = $('#lang'),
            orderid = $('#smitem_orderid'),
            boximg = $('.box-img'),
            img = $('#imgsmitem');
            if(menuid.val()==0){
                alert("Please input menuID");
                menuid.focus();
                return;
            }else if(submenuid.val() == 0){
                alert("Please input submenuID");
                submenuid.focus();
                return;
            }
            else if(title.val()==""){
                alert("please input title");
                title.focus();
                return;
            }else if(img.val()==""){
                alert("Please choose image");
                return;
            }
            tinymce.triggerSave();
        let frm = eThis.closest('form.uploadsubmenuitem');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url: "InsertDataToDatabase/InsertDataSubMenuItem.php",
            type:"POST",
            data: frm_data,
            contentType:false,
            caches: false,
            processData:false,
            dataType:"json",
            beforeSend:function(){

            },
            success:function(data){
         
                if(data.edit == false){
                    let tr = `
                        <tr>
                            <td>${id.val()}</td>
                            <td><span hidden>${submenuid.val()}</span> ${submenuid.find('option:selected').text()} </td>
                            <td><span hidden>${menuid.val()}</span> ${menuid.find('option:selected').text()} </td>
                            <td>${userid.val()}</td>
                            <td>${title.val()}</td>
                            <td>${orderid.val()}</td>
                            <td>${data.view}</td>
                            <td>${status.val()}</td>
                            <td>${lang.val()}</td>
                            <td>${data.date}</td>
                            <td><img src="../Admin/Images/${img.val()}" alt="${img.val()}" width="60" height="40"></td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>

                        </tr>
                    `;
                    tbldata.find('tr:eq(0)').after(tr);
                    
                    title.val("");
                    title.focus();
                    boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                    img.val("");

                    id.val(data.autoid + 1);
                    orderid.val(data.autoid + 1);
                }else{
                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).html(`<span hidden>${submenuid.val()}</span> ${submenuid.find('option:selected').text()}` );
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).html(`<span hidden>${menuid.val()}</span> ${menuid.find('option:selected').text()} `);
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(4)`).text(title.val());
                    body.find(`tr:eq(${indexrow}) td:eq(5)`).text(orderid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(6)`).text(data.view);
                    body.find(`tr:eq(${indexrow}) td:eq(7)`).text(status.val());
                    body.find(`tr:eq(${indexrow}) td:eq(8)`).text(lang.val());
                    body.find(`tr:eq(${indexrow}) td:eq(9)`).text(data.date);
                    body.find(`tr:eq(${indexrow}) td:eq(10) img`).attr('src','../Admin/Images/'+img.val()+'');
                    body.find(`tr:eq(${indexrow}) td:eq(10) img`).attr('alt',''+img.val()+'');
                    overlay.hide();
                }
            }

        })
    }

     
    const GetDataSubMenuItem = () =>{
        let th = `
            <tr>
                <th>Id</th>
                <th>SubMenuID</th>
                <th>MenuID</th>
                <th>UserID</th>
                <th>Title</th>
                <th>OrderID</th>
                <th>View</th>
                <th>Status</th>
                <th>Lang</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: "GetDataSubMenuItem/GetDataSubMenuItem.php",
            type:"POST",
            data: {
                'start' : start,
                'end': end,
                'conditionsearch': conditionsearch,
                'valuesearch':valuesearch.val(),
                'optionsearch':filtersearchvalue.val(),
            },
            // contentType:false,
            caches: false,
            // processData: false,
            dataType:"json",
            beforeSend:function(){

            },
            success: function(data){
              
                if(data.length == '0'){
                    tbldata.html(th);
                    totaldata.text(0);
                    totalpage.text(1);
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                   data.map((item,id)=>{
                        tr += `
                            <tr>
                                <td>${item.smitem_id}</td>
                                <td><span hidden>${item.submenuid}</span>${item.submenutitle}</td>
                                <td><span hidden>${item.menuid}</span>${item.menutitle}</td>
                                <td>${item.userid}</td>
                                <td>${item.smitem_title}</td>
                                <td>${item.smitem_orderid}</td>
                                <td>${item.smitem_view}</td>
                                <td>${item.smitem_status}</td>
                                <td>${item.lang}</td>
                                <td>${item.smitem_date}</td>
                                <td><img src="../Admin/Images/${item.smitem_img}" alt="${item.smitem_img}" width="60" height="40"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                   });
                tbldata.html(th + tr);
            }
        })
    }

    
    const GetEditSubMenuItem = (eThis) =>{
        let parent = eThis.parents('tr');
        let id = parent.find("td:eq(0)").text(),
            submenuid = parent.find("td:eq(1) span").text(),
            menuid = parent.find("td:eq(2) span").text(),
            userid = parent.find("td:eq(3)").text(),
            title = parent.find("td:eq(4)").text(),
            orderid = parent.find("td:eq(5)").text(),
            status = parent.find("td:eq(7)").text(),
            lang = parent.find("td:eq(8)").text(),
            img = parent.find("td:eq(10) img").attr('alt');
            indexrow = parent.index();
            
        overlay.show();
        overlay.load(""+form[optionitem]+"", function(responseTxt, statusText){
            if(statusText == "success"){

                $.ajax({
                    url:"GetEditSubMenuItem/GetEditSubMenuItem.php",
                    type: "POST",
                    data: {"id":id},
                    caches: false,
                    dataType: "json",
                    beforeSend: function(){

                    },
                    success: function(data){
                    body.find("#smitemid").val(id);
                    body.find("#userid").val(userid);
                    body.find("#menuid").val(menuid);
                    body.find("#submenuid").val(submenuid);
                    body.find("#smitem_title").val(title);
                    body.find("#smitem_detail").val(data.detail);
                    body.find("#smitem_orderid").val(orderid);
                    body.find("#smitem_status").val(status);
                    body.find('#lang').val(lang);
                    body.find('#imgsmitem').val(img);
                    body.find('.box-img').css({"backgroundImage":"url('../Admin/Images/"+img+"')"});
                    body.find('#editid').val(id);
                    calleditor();
                    }
                })
                

            }

            if(statusText == "error"){
                alert('Error' + xhr.status + ':' + xhr.statusText)
            }
        })
    }

    
    const SaveDataAds = (eThis) => {
        let frm = eThis.closest('form.uploadads');
        let frm_data = new FormData(frm[0]);
        
        let id = $('#adsid'),
            userid = $('#userid'),
            url = $('#adsurl'),
            img = $('#imgads'),
            type = $('#adstype'),
            status = $('#adsstatus');
        $.ajax({
            url: "InsertDataToDatabase/InsertDataAds.php",
            type: "POST",
            data: frm_data,
            contentType:false,
            caches:false,
            processData:false,
            dataType:"json",
            beforsen:function(){

            },
            success: function(data){
             
                if(data.edit == false){
                    let tr = `
                        <tr>
                            <td>${id.val()}</td>
                            <td>${userid.val()}</td>
                            <td>${url.val()}</td>
                            <td>${type.val()}</td>
                            <td>${status.val()}</td>
                            <td><img src="../Admin/Images/${img.val()}" alt="${img.val()}" width="60" height="40"></td>
                            <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>

                        </tr>
                    `;
                    tbldata.find('tr:eq(0)').after(tr);
                    id.val(data.autoid +1);
                    url.val("");
                    url.focus();
                    img.val("");
                    $('.box-img').css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                }else{
                    body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                    body.find(`tr:eq(${indexrow}) td:eq(1)`).text(userid.val());
                    body.find(`tr:eq(${indexrow}) td:eq(2)`).text(url.val());
                    body.find(`tr:eq(${indexrow}) td:eq(3)`).text(type.val());
                    body.find(`tr:eq(${indexrow}) td:eq(4)`).text(status.val());
                    body.find(`tr:eq(${indexrow}) td:eq(5) img`).attr('src','../Admin/Images/'+img.val()+'');
                    body.find(`tr:eq(${indexrow}) td:eq(5) img`).attr('alt',''+img.val()+'');
                    overlay.hide();
                }
            }
        })

    }

     
    const GetDataAds = () =>{
        let th = `
            <tr>
                <th>Id</th>
                <th>UserID</th>
                <th>URL</th>
                <th>TYPE</th>
                <th>STATUS</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        `;
        let tr = "";
        $.ajax({
            url: "GetDataAds/GetDataAds.php",
            type:"POST",
            data: {
                'start' : start,
                'end': end,
                'conditionsearch': conditionsearch,
                'valuesearch':valuesearch.val(),
                'optionsearch':filtersearchvalue.val(),
            },
            // contentType:false,
            caches: false,
            // processData: false,
            dataType:"json",
            beforeSend:function(){

            },
            success: function(data){
              
                if(data.length == '0'){
                    tbldata.html(th);
                    totaldata.text(0);
                    totalpage.text(1);
                }
                totaldata.text(data[0]['total']);
                totalpage.text(Math.ceil(data[0]['total'] / end));
                   data.map((item,id)=>{
                        tr += `
                            <tr>
                                <td>${item.adsid}</td>
                                <td>${item.userid}</td>
                                <td>${item.adsurl}</td>
                                <td>${item.adstype}</td>
                                <td>${item.adsstatus}</td>
                                <td><img src="../Admin/Images/${item.adsimg}" alt="${item.adsimg}" width="60" height="40"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                        `;
                   });
                tbldata.html(th + tr);
            }
        })
    }

    const GetEditAds = (eThis) =>{
        let parent = eThis.parents('tr');
        let id = parent.find('td:eq(0)').text(),
            userid = parent.find('td:eq(1)').text(),
            url = parent.find('td:eq(2)').text(),
            type = parent.find('td:eq(3)').text(),
            status = parent.find('td:eq(4)').text(),
            img = parent.find('td:eq(5) img').attr('alt');
            indexrow = parent.index();
        overlay.show();
        overlay.load(""+form[optionitem]+"", function(responseTxt, statusText){
            if(statusText == "success"){

                body.find('#adsid').val(id);
                body.find('#userid').val(userid);
                body.find('#adsurl').val(url);
                body.find('#adstype').val(type);
                body.find('#adsstatus').val(status);
                body.find('#imgads').val(img);
                body.find('.box-img').css({'backgroundImage':'url("../Admin/Images/'+img+'")'});
                body.find('#editid').val(id);

            }

            if(statusText == "error"){
                alert('Error' + xhr.status + ':' + xhr.statusText);
            }
        })
    }
    
    body.on('click', '.btn-save', function () {
     
        let eThis = $(this);
        if(optionitem == 0){
            SaveDataUser(eThis);
        }
        else if (optionitem == 1) {
            SavePermission(eThis);

        }else if(optionitem == 2){
            SaveDataMenu(eThis);
        }else if(optionitem == 3){
            SaveDataMenuItem(eThis);
        }else if(optionitem == 4){
            SaveDataSubMenu(eThis);
        }else if(optionitem == 5){
            SaveDataSubMenuItem(eThis);
        }else if(optionitem == 6){
            SaveDataAds(eThis);
        }else if(optionitem == 7){
           SaveDataMenu_Submenu(eThis);
        }
    });


    // Getauto id
    const GetAutoid = () => {

        $.ajax({
            url: 'GetAutoid/GetAutoid.php',
            type: 'POST',
            data: {
                "table": optionitem 
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
              
                body.find('.uploaduser #id').val(parseInt(data.autoid)+1);
                body.find('.uploadpermission #id').val(parseInt(data.autoid) + 1);
                body.find('.uploadmenu #menuid').val(parseInt(data.autoid)+1);
                body.find('.uploadmenu #menuorderid').val(parseInt(data.autoid)+1);
                body.find('.uploadmenuitem #mitemid').val(parseInt(data.autoid)+1);
                body.find('.uploadmenuitem #mitem_orderid').val(parseInt(data.autoid)+1);
                body.find('.uploadsubmenu #submenuid').val(parseInt(data.autoid)+1);
                body.find('.uploadsubmenu #submenu_orderid').val(parseInt(data.autoid)+1);
                body.find('.uploadsubmenuitem #smitemid').val(parseInt(data.autoid) + 1);
                body.find('.uploadsubmenuitem #smitem_orderid').val(parseInt(data.autoid) + 1);
                body.find('.uploadads #adsid').val(parseInt(data.autoid)+1);
               
            }
        });

    }



    const SaveDataMenu_Submenu = (eThis) => {
        

        let frm = eThis.closest('form.uploadmenusubmenu');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"InsertDataToDatabase/InsertDataMenu_Submenu.php",
            type:"POST",
            data:frm_data,
            contentType:false,
            caches: false,
            processData:false,
            // dataType: "json",
            beforeSend:function(){
                
            },
            success: function(data){
                
                alert("success")
                // if(data.dpl == true){
                //     alert("Duplicate Email Please Input again");
                // }else{
                //     if(data.edit == false){
                //         let tr = `
                //                 <tr>
                //                     <td>${id.val()}</td>
                //                     <td>${username.val()}</td>
                //                     <td>${useremail.val()}</td>
                //                     <td>${data.userpass}</td>
                //                     <td>${usertype.val()}</td>
                //                     <td>${data.userip}</td>
                //                     <td>${data.codeverify}</td>
                //                     <td>${userstatus.val()}</td>
                //                     <td><img src="../Admin/Images/${imguser.val()}" alt="${imguser.val()}" width="60" height="40"></td>
                //                     <td>${data.userdate}</td>
                //                     <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>

                //                 </tr>
                //              `;

                //             tbldata.find('tr:eq(0)').after(tr);
                //             totaldata.text(parseInt(totaldata.text())+1);
                //             id.val(data.autoid + 1);
                //             username.val("");
                //             useremail.val("");
                //             imguser.val("");
                //             username.focus();
                //             useremail.focus();
                //             boximg.css({'backgroundImage':'url("../Admin/Images/profile.jpg")'});
                //     }else{
                //         body.find(`tr:eq(${indexrow}) td:eq(0)`).text(id.val());
                //         body.find(`tr:eq(${indexrow}) td:eq(1)`).text(username.val());
                //         body.find(`tr:eq(${indexrow}) td:eq(2)`).text(useremail.val());
                //         body.find(`tr:eq(${indexrow}) td:eq(3)`).text(data.userpass);
                //         body.find(`tr:eq(${indexrow}) td:eq(4)`).text(usertype.val());
                //         body.find(`tr:eq(${indexrow}) td:eq(5)`).text(data.userip);
                //         body.find(`tr:eq(${indexrow}) td:eq(6) `).text(data.codeverify);
                //         body.find(`tr:eq(${indexrow}) td:eq(7)`).text(userstatus.val());
                //         body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('src','../Admin/Images/'+imguser.val()+'');
                //         body.find(`tr:eq(${indexrow}) td:eq(8) img`).attr('alt',''+imguser.val()+'');
                //         body.find(`tr:eq(${indexrow}) td:eq(9)`).text(data.dateuser);
                //         overlay.hide();
                //     }
                   
                // }
              
            }
        })
    }
    


    

    
    body.on('change','#img-fileuser',function(){
        let eThis = $(this);
        let frm = eThis.closest('form.uploaduser');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"UploadImage/UploadImageUser.php",
            type:"POST",
            data:frm_data,
            contentType:false,
            caches:false,
            processData:false,
            dataType:"json",
            beforeSend: function(){

            },
            success:function(data){
                $('.box-img').css({'backgroundImage':'url("../Admin/Images/'+data.img+'")'})
                $('#imguser').val(data.img);
            }
        })

    });

    body.on('change',"#img-filemenu",function(){
        let eThis = $(this);
        let frm = eThis.closest('form.uploadmenu');
        let frm_data = new FormData(frm[0]);
        $.ajax({
            url:"UploadImage/UploadImageMenu.php",
            type: "POST",
            data: frm_data,
            contentType:false,
            caches:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){

            },
            success:function(data){
               $('.box-img').css({'backgroundImage':`url('../Admin/Images/${data.img}')`});
               $('#imgmenu').val(data.img);
            }
        })
    })

    body.on('change','#img-filemitem', function(){
       let eThis = $(this);
       let frm = eThis.closest('form.uploadmenuitem');
       let frm_data = new FormData(frm[0]);
       $.ajax({
            url:"UploadImage/UploadImageMenuItem.php",
            type:"POST",
            data: frm_data,
            contentType:false,
            caches: false,
            processData: false,
            dataType:"json",
            beforeSend: function(){

            },
            success: function(data){
                body.find('#imgmitem').val(data.img);
                body.find('.box-img').css({'backgroundImage':'url("../Admin/Images/'+data.img+'")'});
            }
       })
    })

    body.on('change','#img-filesubmenu', function(){
       
        let eThis = $(this);
        let frm = eThis.closest('form.uploadsubmenu');
        let frm_data = new FormData(frm[0]);
        $.ajax({
             url:"UploadImage/UploadImageSubMenu.php",
             type:"POST",
             data: frm_data,
             contentType:false,
             caches: false,
             processData: false,
             dataType:"json",
             beforeSend: function(){
 
             },
             success: function(data){
                 body.find('#imgsubmenu').val(data.img);
                 body.find('.box-img').css({'backgroundImage':'url("../Admin/Images/'+data.img+'")'});
             }
        })
     })

     body.on('change','#img-filesmitem', function(){
       
        let eThis = $(this);
        let frm = eThis.closest('form.uploadsubmenuitem');
        let frm_data = new FormData(frm[0]);
        $.ajax({
             url:"UploadImage/UploadImageSubMenuItem.php",
             type:"POST",
             data: frm_data,
             contentType:false,
             caches: false,
             processData: false,
             dataType:"json",
             beforeSend: function(){
 
             },
             success: function(data){
                 body.find('#imgsmitem').val(data.img);
                 body.find('.box-img').css({'backgroundImage':'url("../Admin/Images/'+data.img+'")'});
             }
        })
    })

    body.on('change','#img-fileads', function(){
       
        let eThis = $(this);
        let frm = eThis.closest('form.uploadads');
        let frm_data = new FormData(frm[0]);
        $.ajax({
             url:"UploadImage/UploadImageAds.php",
             type:"POST",
             data: frm_data,
             contentType:false,
             caches: false,
             processData: false,
             dataType:"json",
             beforeSend: function(){
 
             },
             success: function(data){
                 body.find('#imgads').val(data.img);
                 body.find('.box-img').css({'backgroundImage':'url("../Admin/Images/'+data.img+'")'});
             }
        })
    })

    $('.optionshow').change(function(){
        end = $(this).val();
       
        if(optionitem == 0){
            GetDataUser();
        }
        else if(optionitem == 1){
            GetDataPermission();
        }else if(optionitem == 2){
            GetDataMenu();
        }
        else if(optionitem == 3){
            GetDataMenuItem();
        }
        else if(optionitem == 4){
           GetDataSubMenu();
        }
        else if(optionitem == 5){
            GetDataSubMenuItem();
         }
         else if(optionitem == 6){
            GetDataAds();
         }
    })

    btnnext.click(function(){
        if(optionitem == 0){
            if(currentpage.text() == totalpage.text()){
                alert("End Page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
                GetDataUser();
            }
        }else if(optionitem == 1){
            
            if(currentpage.text() == totalpage.text()){

                alert("End Page");
         
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
                GetDataPermission();
            }
           
        }else if(optionitem == 2){
            if(currentpage.text()== totalpage.text()){
                alert("End page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
                GetDataMenu();
            }
        }
        else if(optionitem == 3){
            if(currentpage.text()== totalpage.text()){
                alert("End page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
                GetDataMenuItem();
            }
        }
        else if(optionitem == 4){
            if(currentpage.text()== totalpage.text()){
                alert("End page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
               GetDataSubMenu();
            }
        }
        else if(optionitem == 5){
            if(currentpage.text()== totalpage.text()){
                alert("End page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
               GetDataSubMenuItem();
            }
        }
        else if(optionitem == 6){
            if(currentpage.text()== totalpage.text()){
                alert("End page");
            }else{
                currentpage.text(parseInt(currentpage.text())+1);
                start += parseInt(end);
               GetDataAds();
            }
        }
    })

    btnback.click(function(){
        if(optionitem == 0){
            if(currentpage.text() == 1){
                alert("End Page");
            }else{
                currentpage.text(parseInt(currentpage.text()) -1);
                start -= parseInt(end);
                GetDataUser();
            }
        }else if(optionitem == 1){
            
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
                GetDataMenu();
            }
           
        }
        else if(optionitem == 2){
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
               GetDataMenu();
            }
           
        }
        else if(optionitem == 3){
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
               GetDataMenuItem();
            }
           
        }
        else if(optionitem == 4){
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
               GetDataSubMenu();
            }
           
        }
        else if(optionitem == 5){
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
               GetDataSubMenuItem();
            }
           
        }
        else if(optionitem == 6){
            if(currentpage.text() == 1){
                alert("End Page");
                
            }else{
                currentpage.text(parseInt(currentpage.text())-1);
                start -= parseInt(end);
               GetDataAds();
            }
           
        }
    });


    
    function calleditor() {
        tinymce.remove();
        tinymce.init({
            selector: "textarea", theme: "modern", width: "600", height: "350", relative_urls: false, remove_script_host: false,
            file_browser_callback: function (field_name, url, type, win) {
                var filebrowser = "../Admin/js/filebrowser.php";
                filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
                tinymce.activeEditor.windowManager.open({
                    title: "Insert Photo",
                    width: 660,
                    height: 500,
                    url: filebrowser
                }, {
                    window: win,
                    input: field_name
                });
                return false;
            },
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools media code",
            ],
            menubar: true, toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
            toolbar2: "fontselect | fontsizeselect | forecolor media code",
        });
    }

});
