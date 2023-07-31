<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PropLogix Cert</title>

    <style>
        /* .pdf_page {
            position: absolute;
            width: 725px;
            height: 1400px;
            background-color: aqua;
            left: -10px;
            top: -45px;
            font-size: 8px;
        } */

        .info_header_table>tr>td,
        .notes_header_table>tr>td {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
        }

        .info_body_table .odd {
            font-size: 14px;
            padding-top: 4px;
        }

        .info_body_table .even {
            font-size: 12px;
            padding-top: 4px;
        }

        .info_body_firstrow .odd,
        .info_body_firstrow .even {
            padding-top: 8px;
        }

        .notes_body_table .odd {
            font-size: 12px;
            padding-top: 4px;
        }

        .notes_body_table .even {
            font-size: 12px;
            padding-top: 10px;
        }

        /* header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; } */
        footer {
            position: fixed;
            bottom: -70px;
            left: 0px;
            right: 0px;
            height: 70px;
        }

        p {
            page-break-after: always;
        }

        p:last-child {
            page-break-after: never;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            font-weight: 600;
        }

        #footer {
            position: fixed;
            left: 0;
            right: 0;
            color: #ffffff;
            font-size: 12px;
        }

        .page-number:before {
            content:  "Page " counter(page);
        }

    </style>
</head>

<body>


</div>
    <footer>
        <table class='footer_table' style="color: white;background-color: {{$orders_export_data->customer_color_code}}">
            <tr class='footer'>
                <td style="text-align: start;width: 100px;">{{$orders_export_data->batch_name}}</td>
                <td id="footer" class="page-number" style="width: 420px;"></td>
                <td style="text-align: end;width: 170px;">{!! date('l, F jS Y') !!}</td>
            </tr>
        </table>
    </footer>
    <section class="pdf_page">
    <table class='logo_table'>
        <tr>
            <td><img src="data:image;base64,{{$orders_export_data->customer_logo}}"
                    style="paddind-bottom:20px;position: relative;top: -20px;width: 250px; margin-left: 230px;"></td>
        </tr>
    </table>
    <table style="color: white;background-color: {{$orders_export_data->customer_color_code}}">
        <thead class='info_header_table'>
            <tr>
                <td colspan="2" style="width: 260px;">Property Information</td>
                <td colspan="2" style="width: 215px;">Request Information</td>
                <td colspan="2" style="width: 235px;">Update Information</td>
            </tr>
        </thead>
    </table>
    <table>
        <tbody class='info_body_table'>
            <tr class='info_body_firstrow'>
                <td class="odd" style="width: 90px;">File#:</td>
                <td class="even" style="width: 190px;">{{$orders_export_data->app_number}}</td>
                <td class="odd" style="width: 115px;">Requested Date:</td>
                <td class="even" style="width: 90px;">{!! date("m/d/Y",
                    strtotime($orders_export_data->requested_date)) !!}</td>
                <td class="odd" style="width: 115px;">Update Requested:</td>
                <td class="even" style="width: 90px;">{!! date("m/d/Y", strtotime($orders_export_data->updated_date))
                    !!}</td>
            </tr>
            <tr>
                <td class="odd">Owner:</td>
                <td class="even">{!! ucfirst($orders_export_data->borrower_firstname) !!} {!!
                    ucfirst($orders_export_data->borrower_lastname) !!}</td>
                <td class="odd">Branch:</td>
                <td class="even"></td>
                <td class="odd">Requested By:</td>
                <td class="even">{!! ucfirst($orders_export_data->first_name) !!} {!!
                    ucfirst($orders_export_data->last_name) !!}</td>
            </tr>
            <tr>
                <td class="odd">Address 1:</td>
                <td class="even">{{$orders_export_data->address}}</td>
                <td class="odd">Date Completed:</td>
                @if(isset($orders_export_data->completion_date))
                <td class="even">{!! date("m/d/Y", strtotime($orders_export_data->completion_date)) !!}</td>
                @else
                <td class="even"></td>
                @endif
                <td class="odd">Update Completed:</td>
                @if(isset($orders_export_data->updated_at))
                <td class="even">{!! date("m/d/Y", strtotime($orders_export_data->updated_at)) !!}</td>
                @else
                <td class="even"></td>
                @endif
            </tr>
            <tr>
                <td class="odd" style="padding-bottom: 12px;">Address 2:</td>
                <td class="even" style="padding-bottom: 12px;"></td>
                <td class="odd"># of Jurisdiction(s):</td>
                <td class="even"></td>
            </tr>
            <tr>
                <td class="odd">City, State Zip:</td>
                <td class="even">{{$orders_export_data->property_city}}, {{$orders_export_data->short_code}} {!!
                    (strlen($orders_export_data->property_zip) == 4) ? "0$orders_export_data->property_zip" :
                    $orders_export_data->property_zip !!}</td>
                <td class="odd"># of Parcel(s):</td>
                <td class="even">{{$orders_export_data->parcel_count}}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table style="color: white;background-color: {{$orders_export_data->customer_color_code}}">
        <thead class='notes_header_table'>
            <tr>
                <td colspan="2" style="width: 720px;">Notes</td>
            </tr>
        </thead>
    </table>
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;">CODE VIOLATIONS</td>
                <td class="even" style="width: 542px;">{!! nl2br($orders_export_data->code_violation) !!}</td>
            </tr>
            <tr>
                <td class="odd" style="width: 152px;">PERMITS</td>
                <td class="even" style="width: 542px;">{!! nl2br($orders_export_data->permits) !!}</td>
            </tr>
            <tr>
                <td class="odd" style="width: 152px;">SPECIAL ASSESSMENTS</td>
                <td class="even" style="width: 542px;">{!! nl2br($orders_export_data->special_assessment) !!}</td>
            </tr>
            <tr>
                <td class="odd" style="width: 152px;">DEMOLITION PERMIT</td>
                <td class="even" style="width: 542px;">{{$orders_export_data->demolition_permit}}</td>
            </tr>
            <tr>
                <td class="odd" style="width: 152px;">UTILITIES</td>
                <td class="even" style="width: 542px;">{{$orders_export_data->utility}}</td>
            </tr>
        </tbody>
    </table>
    @if (isset($orders_export_data->water_status))
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;">UTILITIES</td>
                <td class="even" style="width: 542px;">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan='2'><strong>WATER:</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            @foreach($orders_export_data as $key => $value)
                            @if (str_starts_with($key, 'water_'))
                            <tr>
                                <td width="100px"> {!! ucwords(str_replace('_'," ",$key)) !!}: @if(str_ends_with($key,
                                    '_due')) </td>
                                <td>${{$value}}</td>
                            </tr> @elseif(str_ends_with($key, '_date') && $value != NULL && $value != "")
                </td>
                <td>{!! date("m/d/Y", strtotime($value)) !!}</td>
            </tr>  @elseif(str_ends_with($key, '_summary')) </td>
            <td>{!! nl2br($value) !!}</td>
            </tr> @else </td>
            <td>{{$value}}</td>
            </tr> @endif
            @endif
            @endforeach
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    @else
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;position:absolute;top:100px">UTILITIES</td>
                <td class="even" style="width: 542px;"></td>
            </tr>
        </tbody>
    </table>
    @endif
    @if (isset($orders_export_data->sewer_status))
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;"></td>
                <td class="even" style="width: 542px;">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan='2'><strong>SEWER:</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            @foreach($orders_export_data as $key => $value)
                            @if (str_starts_with($key, 'sewer_'))
                            <tr>
                                <td width="100px"> {!! ucwords(str_replace('_'," ",$key)) !!}: @if(str_ends_with($key,
                                    '_due')) </td>
                                <td>${{$value}}</td>
                            </tr> @elseif(str_ends_with($key, '_date') && $value != NULL && $value != "")
                </td>
                <td>{!! date("m/d/Y", strtotime($value)) !!}</td>
            </tr> @elseif(str_ends_with($key, '_summary')) </td>
            <td>{!! nl2br($value) !!}</td>
            </tr>  @else </td>
            <td>{{$value}}</td>
            </tr> @endif
            @endif
            @endforeach
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    @endif
    @if (isset($orders_export_data->garbage_status))
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;"></td>
                <td class="even" style="width: 542px;">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan='2'><strong>GARBAGE:</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            @foreach($orders_export_data as $key => $value)
                            @if (str_starts_with($key, 'garbage_'))
                            <tr>
                                <td width="100px"> {!! ucwords(str_replace('_'," ",$key)) !!}: @if(str_ends_with($key,
                                    '_due')) </td>
                                <td>${{$value}}</td>
                            </tr> @elseif(str_ends_with($key, '_date') && $value != NULL && $value != "")
                </td>
                <td>{!! date("m/d/Y", strtotime($value)) !!}</td>
            </tr> @elseif(str_ends_with($key, '_summary')) </td>
            <td>{!! nl2br($value) !!}</td>
            </tr>  @else </td>
            <td>{{$value}}</td>
            </tr> @endif
            @endif
            @endforeach
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    @endif
    @if (isset($orders_export_data->utility_status))
    <table>
        <tbody class='notes_body_table'>
            <tr>
                <td class="odd" style="width: 152px;"></td>
                <td class="even" style="width: 542px;">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan='2'><strong>OTHER UTILITIES:</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            @foreach($orders_export_data as $key => $value)
                            @if (str_starts_with($key, 'utility_') || str_starts_with($key, 'code_') ||
                            str_starts_with($key, 'special_') || str_starts_with($key, 'demolition_sum'))
                            <tr>
                                <td width="100px"> {!! ucwords(str_replace('_'," ",$key)) !!}: @if(str_ends_with($key,
                                    '_due')) </td>
                                <td>${{$value}}</td>
                            </tr> @elseif(str_ends_with($key, '_date') && $value != NULL && $value != "")
                </td>
                <td>{!! date("m/d/Y", strtotime($value)) !!}</td>
            </tr> @elseif(str_ends_with($key, '_summary')) </td>
            <td>{!! nl2br($value) !!}</td>
            </tr> @else </td>
            <td>{{$value}}</td>
            </tr> @endif
            @endif
            @endforeach
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    @endif
    </section>
    {{-- <script type="text/php">
        if (isset($pdf)) {
            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
            $size = 10.5;
            $font = $fontMetrics->getFont("helvetica", "B", 600);
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width + 10) / 2;
            $y = $pdf->get_height() - 37;
            $color = array(255, 255, 255);
            $pdf->page_text($x, $y, $text, $font, $size, $color);
        }
    </script> --}}
</body>

</html>
