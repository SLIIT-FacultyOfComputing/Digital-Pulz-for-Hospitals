var baseUrl="http://localhost";
function userLogin(){
document.getElementById("imgid").style.visibility = "visible";
var userName = document.getElementById("userNameValue").value;
var password = document.getElementById("passwordValue").value;
var usr_permission= [];
var usr_spcl_permission = [];

if(userName.length==0 || password.length==0)
{
    alert('Please Enter Username and Password!!!');
}
else
{
    
    $.ajax({
        url: base+'/eHealth_proj/index.php/user_controller/authenticate',
        type: 'POST',
        crossDomain: true,
        data: {"userName":userName ,"password":password},
        success: function(data) {
            data = trimData(data);
            if(data=="false")
            {
                alert("Invalid Username or Password. Please Try again!!!");
                document.getElementById("imgid").style.visibility = "hidden";
            }
            else
            {
                 var json_parsed   = $.parseJSON(data);
                 var $userID       = json_parsed[0]['userID'];
                 var $userName     = json_parsed[0]['userName'];
                 var $userRoleID   = json_parsed[0]['userRoles']['userRoleID'];
                 var $userRoleName = json_parsed[0]['userRoles']['userRoleName'];
                 
                 for (var j = 0; j < json_parsed[0]['specialPermissions'].length; j++)
                 {
                     usr_spcl_permission.push({spcl:json_parsed[0]['specialPermissions'][j]['permission']})
                 }
                 for (var i = 0; i < json_parsed[0]['userRoles']['permissions'].length; i++) {
                     //alert(json_parsed[0]['userRoles']['permissions'][i]['permission']);
                    usr_permission.push({per:json_parsed[0]['userRoles']['permissions'][i]['permission']});
                 }
                 //alert(usr_permission);
                 createSessionUC($userID,$userName,$userRoleID,$userRoleName,usr_permission,usr_spcl_permission);
                 document.getElementById("imgid").style.visibility = "hidden";
            }
        }
    });
}
}

function createSessionUC(userID,userName,userRoleID,userRoleName,userPermissions,spclPermission)
{
        $.ajax({
        url: baseUrl+'/eHealth_proj/index.php/user_controller/createSession',
        type: 'POST',
        crossDomain: true,
        data: {"userID":userID ,"userName":userName,"userRoleID":userRoleID,"userRoleName":userRoleName,"userPermissions":userPermissions, "spclPermission":spclPermission},
        success: function(data) {
                    data = trimData(data);
                   alert(data);
                   if(userRoleName=="Chief Pharmacist"){
                   window.location = baseUrl+'/eHealth_proj/index.php/Report_Controller/report';
                   }
                   else{
                   window.location = baseUrl+'/eHealth_proj/index.php/Prescribe_Controller';    
                   }
                   }
    });
}

function addPharmacist(){

    var title       = $("#titleDropDown option:selected").text();
    var firstName   = document.getElementById("firstNameValue").value;
    var lastName    = document.getElementById("lastNameValue").value;
    var nic         = document.getElementById("nicValue").value;
    var dob         = document.getElementById("dobValue").value;
    var civilStatus = $("#civilStatusDropDown option:selected").text();
    var gender      = $("#genderDropDown option:selected").text();
    var userGroup   = $("#userGroupDropDown option:selected").text();
    var userDep     = $("#userDepDropDown option:selected").text();
    var userName    = document.getElementById("userNameValue").value;
    var password    = document.getElementById("passwordValue").value;
    var street      = document.getElementById("streetValue").value;
    var division    = document.getElementById("divisionValue").value;
    var district    = document.getElementById("districtValue").value;
    var fnameError  = $("#fnameerror").text();
    var lnameError  = $("#lnameerror").text();
    var nicError  = $("#nicerror").text();
    var dobError  = $("#doberror").text();
    var userError  = $("#usererror").text();
    var passError  = $("#passerror").text();
    var streetError  = $("#streeterror").text();
    var divError  = $("#diverror").text();
    var disError  = $("#diserror").text();
    
    if(firstName.length==0 || lastName.length==0 || nic.length==0 || dob.length==0 || userName.length==0 || password.length==0 || street.length==0 || division.length==0 || district.length==0)
    {
        alert('Please Fill all the Fields');
    }
    else if(fnameError.length !=0 || lnameError.length !=0 || nicError.length != 0 || dobError.length != 0 || userError.length !=0 || passError.length != 0 || streetError.length != 0 || divError.length != 0 || disError.length != 0)
    {
        alert("Some Fields are Invalid!!!");
    }
    else
    {
    $.ajax({
            url: baseUrl+'/eHealth_proj/index.php/User_Controller/addUser',
            type: 'POST',
            crossDomain: true,
            data: {"title":title ,"firstName":firstName,"lastName":lastName,"nic":nic,"dob":dob,"civilStatus":civilStatus,
                   "gender":gender,"userGroup":userGroup,"userDep":userDep,"userName":userName,"password":password,
                   "street":street,"division":division,"district":district},
            success: function(data) {
                 alert(data);
                                 }
         });
    }
}


