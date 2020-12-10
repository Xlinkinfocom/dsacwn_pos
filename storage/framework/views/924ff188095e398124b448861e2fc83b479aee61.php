<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media  print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page  { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>

    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js') ?>"></script>
  
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
    <?php if(preg_match('~[0-9]~', url()->previous())): ?>
        <?php $url = '../../pos'; ?>
    <?php else: ?>
        <?php $url = url()->previous(); ?>
    <?php endif; ?>
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="<?php echo e($url); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> <?php echo e(trans('file.Back')); ?></a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            <?php if($general_setting->site_logo): ?>
                <img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            <?php endif; ?>
            
            <h2><?php echo e(trans('Drawer Open')); ?></h2>
            
            <p><?php echo e(trans('file.Address')); ?>: 
                <br><?php echo e(trans('file.Phone Number')); ?>: 
            </p>
        </div>
        <p><?php echo e(trans('file.Date')); ?>: <br>
            <?php echo e(trans('file.reference')); ?>: <br>
            <?php echo e(trans('file.customer')); ?>: 
        </p>
        <table>
            <tbody>
               
                
               
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Total')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Tax')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Coupon Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Shipping Cost')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.grand total')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th class="centered" colspan="3"><?php echo e(trans('file.In Words')); ?>: <span><?php echo e($general_setting->currency); ?></span> <span></span></th>
                    
                </tr>
            </tfoot>
        </table>
        <table>
            <tbody>
                <tr style="background-color:#ddd;">
                    <td style="padding: 5px;width:30%"><?php echo e(trans('file.Paid By')); ?>: </td>
                    <td style="padding: 5px;width:40%"><?php echo e(trans('file.Amount')); ?>: <?php echo e(trans('0.00')); ?></td>
                    <td style="padding: 5px;width:30%"><?php echo e(trans('file.Change')); ?>: <?php echo e(trans('0.00')); ?></td>
                </tr>
                <tr><td class="centered" colspan="3"><?php echo e(trans('file.Thank you for shopping with us. Please come again')); ?></td></tr>
                
            </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small><?php echo e(trans('file.Invoice Generated By')); ?> <?php echo e($general_setting->site_title); ?>.
            <?php echo e(trans('file.Developed By')); ?> LionCoders</strong></small>
        </div> -->
    </div>
</div>

<script type="text/javascript">
    // function auto_print() {     
    //     window.print()
    // }
    // setTimeout(auto_print, 1000);
</script>
<!-- 
</body>
</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media  print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page  { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
    <?php if(preg_match('~[0-9]~', url()->previous())): ?>
        <?php $url = '../../pos'; ?>
    <?php else: ?>
        <?php $url = url()->previous(); ?>
    <?php endif; ?>
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="<?php echo e($url); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> <?php echo e(trans('file.Back')); ?></a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            <?php if($general_setting->site_logo): ?>
                <img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            <?php endif; ?>
            
            <h2><?php echo e(trans('Drawer Open')); ?></h2>
            
            <p><?php echo e(trans('file.Address')); ?>: 
                <br><?php echo e(trans('file.Phone Number')); ?>: 
            </p>
        </div>
        <p><?php echo e(trans('file.Date')); ?>: <br>
            <?php echo e(trans('file.reference')); ?>: <br>
            <?php echo e(trans('file.customer')); ?>: 
        </p>
        <table>
            <tbody>
               
                
               
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Total')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Tax')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Coupon Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Shipping Cost')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.grand total')); ?></th>
                    <th style="text-align:right"><?php echo e(trans('0.00')); ?></th>
                </tr>
                <tr>
                    <th class="centered" colspan="3"><?php echo e(trans('file.In Words')); ?>: <span><?php echo e($general_setting->currency); ?></span> <span></span></th>
                    
                </tr>
            </tfoot>
        </table>
        <table>
            <tbody>
                <tr style="background-color:#ddd;">
                    <td style="padding: 5px;width:30%"><?php echo e(trans('file.Paid By')); ?>: </td>
                    <td style="padding: 5px;width:40%"><?php echo e(trans('file.Amount')); ?>: <?php echo e(trans('0.00')); ?></td>
                    <td style="padding: 5px;width:30%"><?php echo e(trans('file.Change')); ?>: <?php echo e(trans('0.00')); ?></td>
                </tr>
                <tr><td class="centered" colspan="3"><?php echo e(trans('file.Thank you for shopping with us. Please come again')); ?></td></tr> -->
                <!-- <tr><td><a id="btnFullscreen" title="Full Screen">Full</a></td></tr> -->
        <!--     </tbody>
        </table>
        <div class="centered" style="margin:30px 0 50px">
            <small><?php echo e(trans('file.Invoice Generated By')); ?> <?php echo e($general_setting->site_title); ?>.
            <?php echo e(trans('file.Developed By')); ?> LionCoders</strong></small>
        </div>
    </div>
</div> -->

<script type="text/javascript">
    // function auto_print() {     
    //     window.print()
    // }
    // setTimeout(auto_print, 1000);

    




    // function toggleFullscreen(elem) {
    //     elem = document.documentElement;
    //     if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
    //             if (elem.requestFullscreen) {
    //                 elem.requestFullscreen();
    //             } else if (elem.msRequestFullscreen) {
    //                 elem.msRequestFullscreen();
    //             } else if (elem.mozRequestFullScreen) {
    //                 elem.mozRequestFullScreen();
    //             } else if (elem.webkitRequestFullscreen) {
    //                 elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    //             }
    //         } else {
    //         if (document.exitFullscreen) {
    //             document.exitFullscreen();
    //         } else if (document.msExitFullscreen) {
    //             document.msExitFullscreen();
    //         } else if (document.mozCancelFullScreen) {
    //             document.mozCancelFullScreen();
    //         } else if (document.webkitExitFullscreen) {
    //             document.webkitExitFullscreen();
    //         }
    //     }
    // }
    // if(('#btnFullscreen').length > 0) {
    //     document.getElementById('btnFullscreen').addEventListener('click', function() {
    //         toggleFullscreen();
    //     });
    // }


</script>

</body>
</html>


