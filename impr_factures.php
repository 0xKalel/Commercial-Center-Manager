<html>
<head>

<title></title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.slider.js"></script>

<style type="text/css">

    html,body { margin: 0px; padding: 0px; }

    @font-face {
        font-family: 'Antic';
        font-style: normal;
        font-weight: 400;
        src: local('Antic'), 
        local('Antic-Regular'), 
        url('2GNslY5EMAZwbbytmM9wFw.woff') format('woff');
    }

    #facture {
        width: 1000px;
        margin: 20px auto;
        min-height: 900px;
        border: 1px solid rgb(18,111,150);
        background: none repeat scroll 0 0 rgb(51, 51, 51);
    }

    .table-facture {
        background: lavender;
        margin: 50px auto;
        border-bottom: 5px solid rgb(18,111,150) ;
        border-left: 1px solid rgb(18,111,150) ;
        border-right: 1px solid rgb(18,111,150) ;
    }

    .table-facture table { border-spacing: 0px; }

    .table-facture td {
        overflow: hidden;
        -o-text-overflow: ellipsis; 
        text-overflow: ellipsis;
        padding-top: 10px;
        padding-bottom: 2px;
        padding-right: 20px;
        font-family: 'Antic';
    }

    .table-facture thead { color:orange; background: rgb(18,111,150) ; font-size: 16px; }

    .table-facture thead td { padding-bottom: 10px; }

    .table-facture tbody tr:first-child td { padding-top: 20px; }

    .table-facture tbody tr:last-child td { padding-bottom: 20px; }

    .table-facture tbody td:nth-child(1) { font-weight: bold; }

    .table-facture thead td:nth-child(1),tbody td:nth-child(1) { padding-left: 80px; }

/*    tableau multi cols   */

    #multi-cols { width: 872px; min-height: 300px;}

    #multi-cols thead td:nth-child(1),
    #multi-cols tbody td:nth-child(1) { width: 220px;  max-width: 220px; }

    #multi-cols thead td:nth-child(2),
    #multi-cols tbody td:nth-child(2) { width: 50px; max-width: 50px; }

    #multi-cols thead td:nth-child(3),
    #multi-cols tbody td:nth-child(3) { width: 120px; max-width: 120px; }

    #multi-cols thead td:nth-child(4),
    #multi-cols tbody td:nth-child(4) { width: 37px; max-width: 37px; }

    #multi-cols thead td:nth-child(5),
    #multi-cols tbody td:nth-child(5) { width: 120px; max-width: 120px; }

    #multi-cols thead td:nth-child(6),
    #multi-cols tbody td:nth-child(6) { width: 120px; max-width: 120px; }

/*    tableau mono col   */

    #mono-col { width: 300px; min-height: 200px; }
    #mono-col thead td:nth-child(1),
    #mono-col tbody td:nth-child(1) { width: 200px;  max-width: 200px; }

</style>

</head>

<body>

<!-- <div id='facture'>

    <div class='table-facture' id='multi-cols'>
        <table>
            <thead> 
                <tr> <td> Designation  </td> <td> Qte </td> <td> Prix Unit </td> <td> T.V.A </td> <td> MONT.H.T </td> <td> MONT.T.T.C </td> </tr> 
            </thead>
            <tr> <td> LOCATION LOCAL 1 MOIS </td> <td> 12.00 </td> <td> 25,000.00 </td> <td> 19% </td> <td> 300,000.00 </td> <td> 351,000.00 </td> </tr> 
            <tr> <td> Bureau N=2 </td> <td> 12.00 </td> <td> 25,000.00 </td> <td> 19% </td> <td> 300,000.00 </td> <td> 351,000.00 </td> </tr> 
            <tr> <td> LOCATION LOCAL 1 MOIS </td> <td> 12.00 </td> <td> 25,000.00 </td> <td> 19% </td> <td> 300,000.00 </td> <td> 351,000.00 </td> </tr> 
            <tr> <td> Bureau N=2 </td> <td> 12.00 </td> <td> 25,000.00 </td> <td> 19% </td> <td> 300,000.00 </td> <td> 351,000.00 </td> </tr> 
        </table> 
    </div>

    <div class='table-facture' id='mono-col'>
        <table >
            <thead> 
                <tr> <td> tr test Designation  </td> </tr>  </thead>
                <tr> <td> tr test tel 038 68 77 84  </td> </tr> 
                <tr> <td> tr test tel 038 68 77 84  </td> </tr> 
                <tr> <td> tr test tel 038 68 77 84  </td> </tr> 
            
 
        </table> 
    </div>

     
</div> -->


</body>

</html>