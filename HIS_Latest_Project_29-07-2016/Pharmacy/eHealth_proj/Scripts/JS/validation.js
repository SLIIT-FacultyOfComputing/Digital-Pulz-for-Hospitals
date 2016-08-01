function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {
// Check that current character is number.
        var c = s.charAt(i);
        if(i==0)
        {
            if (((c < "0") || (c > "9"))) return true;
        }
        else
        {
            if (((c < "0") || (c > "9"))) return true;
        }
    }
// All characters are numbers.
    return false;
}

function validateDate(str,id)
    {
        if (str.length==0)
        {
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
        else if (str.length != 10 || isInteger(str.substring(0,4))|| isInteger(str.substring(5,7)) || isInteger(str.substring(8,10)) || str.charAt(4) != '/' || str.charAt(7) != '/')
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Invalid Date. Correct format (yyyy/MM/dd)";
            return false;
        }
        else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
    }
    
function validateQty(str,id)
{
    if (str.length==0)
        {
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else if(isInteger(str) || parseInt(str)<1)
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Invalid Quantity";
            return false;
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
    
}

function validatePid(str,id)
{
    if (str.length==0)
        {
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else if(isInteger(str))
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Invalid PID";
            return false;
        }
    else if(str.length!=3)
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Invalid PID";
            return false;
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
    
}

function validateForm()
{
			var batchNo=document.forms["myform"]["b_no"].value;
                        var batchQty=document.forms["myform"]["b_qty"].value;
                        var bManDate=document.forms["myform"]["b_mdate"].value;
                        var bExpDate=document.forms["myform"]["b_edate"].value;
                        
                        
                        if (batchNo==null || batchNo=="")
                        {
                            alert("Batch Number must be filled out");
                            return false;
                        }
                        else if (batchQty==null || batchQty=="")
                        {
                            alert("Batch Quantity must be filled out");
                            return false;
                        }
                        else if (bManDate==null || bManDate=="")
                        {
                            alert("Manufacture Date must be filled out");
                            return false;
                        }
                        else if (bExpDate==null || bExpDate=="")
                        {
                            alert("Expiry Date must be filled out");
                            return false;
                        }
                        else if (isInteger(batchQty))
                        {
                            alert("Please Enter a valid Quantity");
                            return false;
                        }
                        else if (bManDate.length != 10 || isInteger(bManDate.substring(0,4))|| isInteger(bManDate.substring(5,7)) || isInteger(bManDate.substring(8,10)) || bManDate.charAt(4) != '/' || bManDate.charAt(7) != '/')
                        {
                            alert("Invalid Date of Birth. Correct format (yyyy/MM/dd)");
                            return false;
                        }
                        else if (bExpDate.length != 10 || isInteger(bExpDate.substring(0,4))|| isInteger(bExpDate.substring(5,7)) || isInteger(bExpDate.substring(8,10)) || bExpDate.charAt(4) != '/' || bExpDate.charAt(7) != '/')
                        {
                            alert("Invalid Date of Birth. Correct format (yyyy/MM/dd)");
                            return false;
                        }
                        else
                        {
                            alert("Batch is Valid. You can add the new Batch...!!!");
                        }
                        
                        
}

function validateField(str,id)
{
//    alert("1");
    if (str.length==0)
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
}

function validateNIC(str,id)
{
    if (str.length==0)
        {
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else if (str.length != 10 || (str.charAt(9)!='V' && str.charAt(9)!='v' && str.charAt(9)!='X' && str.charAt(9)!='x') || isInteger(str.substring(0, 9)))
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Invalid NIC";
            return false;   
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
}

function validatePassword(str,id)
{
    if (str.length==0)
        {
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else if(str.length < 6)
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Please enter a minimum of 6 characters";
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
}

function isIntegerFloat(s)
{   var i;
    var j=0;
    for (i = 0; i < s.length; i++)
    {
// Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
        {
            if(c != ".")
            {
               return true;
            }
            else
            {
                j++;
            }           
        }
    }
// All characters are numbers.
    if(j>1)
    {
        return true;
    }
    return false;
}

function validatePrice(str,id)
{
    if (str.length==0)
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Please Enter the Value";
            return false;
        }
    else if (isIntegerFloat(str) || str.indexOf(".") == (str.length-1))
        {
            document.getElementById(id).style.color = 'red';
            document.getElementById(id).innerHTML="Please Enter a valid Price";
            return false;
        }
    else
        {
            document.getElementById(id).innerHTML="";
            return true;
        }
}