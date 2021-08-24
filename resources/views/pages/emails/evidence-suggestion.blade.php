<!doctype html>
<html>

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <link href="{{ asset('bts4/css/email.css') }}" rel="stylesheet">
    <title></title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
</head>

<body>
<div class="es-wrapper-color">
    <!--[if gte mso 9]>
        <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
            <v:fill type="tile" color="#efefef"></v:fill>
        </v:background>
    <![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="esd-email-paddings" valign="top">
                <table cellpadding="0" cellspacing="0" class="es-header" align="center">
                    <tbody>
                    <tr>
                        <td class="esd-stripe" esd-custom-block-id="6021" align="center">
                            <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                <tr>
                                    <td class="esd-structure es-p20" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="esd-container-frame" width="560" valign="top" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-block-image" align="center" style="font-size:0;"><a href="https://sed.work/" target="_blank"><img src="https://i.imgur.com/79c0NAH.png" alt="SED logo" title="SED logo" style="max-width: 500px !important; max-height: 150px !important;padding-bottom: 6% !important;padding-right: 6% !important;"></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                    <tr>
                        <td class="esd-stripe" esd-custom-block-id="6023" align="center">
                            <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                <tbody>
                                <tr>
                                    <td class="esd-structure es-p40t es-p40b es-p30r es-p30l" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="esd-container-frame" esd-custom-block-id="11296" width="540" valign="top" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-block-text" align="left">
                                                                <h3 style="color: #666666;">Hola, {{ $usuario }}, estos son los resultados de tu prueba en SED.<br></h3>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-block-text es-p15t" align="left">
                                                                <p style="color: #999999;">Las evidencias de los siguientes atributos han sido aprobadas, enhorabuena.</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-block-text es-p15t" align="left">
                                                                @foreach ($aprobadas as $aprobada)
                                                                    <p style="color: #999999;"><strong>{{ $aprobada }}</strong></p>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-block-text es-p15t" align="left">
                                                                <p style="color: #999999;">Te recomendamos revisar las evidencias de los siguientes atributos, ya que no han sido aprobadas o bien, no las has ingresado aún.</p>
                                                            </td>
                                                        </tr>
                                                            <?php
                                                            $i = 0;
                                                            foreach ($incorrectas as $incorrecta)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="esd-block-text es-p15t" align="left">
                                                                        <p style="color: #999999;"><strong>Atributo <?php echo $incorrecta; ?></strong></p>
                                                                        <?php
                                                                        ?>
                                                                        <p style="color: #999999;"><strong>Sugerencia: </strong>
                                                                            <?php echo $recomendaciones[$i]; $i++; ?>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="esd-block-text es-p15t" align="left">
                                                                    <p style="color: #999999;"><strong>Observaciones adicionales del analista: </strong></p>
                                                                    <p style="color: #999999;">{{$observacion}}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="esd-block-text es-p15t" align="left">
                                                                    <p style="color: #999999;">Le reviso, <strong>{{ $analista }}</strong>.</p>
                                                                    <p style="color: #999999;">Que tenga un buen día.</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                    <tbody>
                    <tr>
                        <td class="esd-stripe" esd-custom-block-id="6039" align="center">
                            <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                <tr>
                                    <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="esd-container-frame" width="560" valign="top" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-block-text es-p10t es-p15r es-p15l" align="center">
                                                                <p style="font-size: 20px; line-height: 150%;">{{$telefono}}</p>
                                                                <p style="font-size: 14px;">{{$direccion}}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-block-text es-p15t es-p10b es-p15r es-p15l" align="center">
                                                                <p style="line-height: 150%;">Has recibido este correo debido a las evidencias relacionadas con tu prueba en SED, no responder.</p>
                                                                <p style="font-size: 14px;">SED.</p>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="esd-footer-popover es-content" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                    <tr>
                        <td class="esd-stripe" align="center">
                            <table class="es-content-body" style="background-color: transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                <tr>
                                    <td class="esd-structure es-p30t es-p30b es-p20r es-p20l" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="esd-container-frame" width="560" valign="top" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center" class="esd-empty-container" style="display: none;"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>

</html>
