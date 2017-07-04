<?php
/*
------------------------------------------------------------------------------------------------------------------------
DiPMIMS - Digital Pulz Medical Information Management System
Copyright (c) 2017 Sri Lanka Institute of Information Technology
<http: http://his.sliit.lk />
------------------------------------------------------------------------------------------------------------------------
*/
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Drug Request Mail Sender</title>
    </head>
    <body>
        <div font color='#FF0000' align='center'>
            <p><font color="green"><h1>Drug Request Mail Sender</h1></font></p>
        </div>
        <?php
       ( $s = $_POST['asd']);
        $st = substr($s, 0, 1);
        //-------------------------------------------------------

        $dusr = new Report_Controller();
        $details = $dusr->drugReportNew();

        //--------------------------------------------------------------------
        $id = 0;
        $name = 0;
        $cat = 0;
        $price = 0;
        $quty = 0;

        $s=0;
        foreach ($details as $value) {
            $drugPcs = explode(":", $details[$s]);

            if ($drugPcs[1] === $st) {

                $name = $drugPcs[0];
                $cat = $drugPcs[2];
                $price = $drugPcs[3];
                $quty = $drugPcs[4];
            }
            $s++;
        }
        $text = "" . "\n"
                . "Dear Officer" . "\n"
                . "Bellow mentiond drugs are is in low level" . "\n"
                . "Name     :" . $name . "\n"
                . "Catagary :" . $cat . "\n"
                . "Price    :" . $price . "\n"
                . "Quantity :" . $quty . "\n"
                . "plzzz send imediatly bla bla bla " . "\n"
                . "" . "\n"
                . "" . "\n"
                . "Best Regards" . "\n"
                . "Chief Pharmasist" . "\n";

        $subject = "Drug Reorder Request For " . $name;
        ?>

        <form action='http://localhost/Pharmacy/index.php/Report_Controller/sendRequestMail' method='post'>
            <table cellspacing="0" cellpadding="4" border="1" align="center" width="68%">
                <tr>
                    <th bgcolor='#5D7B9D'><font color='#fff' style=" width:10 px ">From :</font></th>
                    <td><input  type="text" name="from" id="from" value="thanveer119@gmail.com" style="width:830px " ></td>
                </tr>
                <tr>
                    <th bgcolor='#5D7B9D'><font color='#fff' style=" width:10 px ">To :</font></th>
                    <td><input  type="text" name="to" id="to" value="thanveer119@gmail.com" style="width:830px " ></td>
                </tr>
                <tr>
                    <th bgcolor='#5D7B9D'><font color='#fff' style=" width:10 px ">Subject :</font></th>
                    <td><input  type="text" name="subject" id="subject" value="<?php echo $subject ?>" style="width:830px "</td>
                </tr>
                <tr >
                    <th align="top" bgcolor='#5D7B9D'><font color='#fff' >Content :</font></th>
                    <td><textarea name="cont" id="cont" rows="15" cols="101">
                            <?php echo $text ?>
                        </textarea></td>
                </tr>
            </table>

            <div align="center">
                <input type="submit" name="submitpdf" value="SEND" align="center"/>
                <input type="hidden" name="id" id="id" value="<?php echo $st; ?>"/>
            </div>
        </form>



        <br><br>
        <div font color='#FF0000' align='center'>
            <p><font color="green"><h1>Mail History For Selected Drug</h1></font></p>
        </div>
        <table cellspacing="0" cellpadding="4" border="2" align="center" width="70%">
                <thead>
                    <tr>
                        <th bgcolor='#5D7B9D'><font color='#fff' font size='10'>Content</font></th>
                        <th bgcolor='#5D7B9D'><font color='#fff' font size="10">Date</font></th>
                    </tr>


                </thead>
        <?php
//-------------------------------------------------------
                            $dusrMail = new Report_Controller();
                            $detailsMailHi = $dusrMail->getMailHistory();
                            $s=0;

                            foreach ($detailsMailHi as $value) {
                                $drugPcsMail = explode("@", $detailsMailHi[$s]);
                                $s++;
                                if($drugPcsMail[0] == $st){
                                         //--------------------------------------------------------------------
        ?>
                <tr>
                        <td align='center'><?php echo $drugPcsMail[1]?></td>
                        <td align='center'><?php echo $drugPcsMail[2]?></td>
                 </tr>
        <?php }}?>
        </table>
    </body>
</html>
