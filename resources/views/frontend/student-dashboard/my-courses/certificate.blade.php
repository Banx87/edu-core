<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
</head>
<style>
    /* CERTIFICATE STYLES */

    /* @media print {
        @page {
            size: A4 landscape;
            margin: 0;
        }

        html,
        body {
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            background: none !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #certificate_body {
            width: 277mm; */
    /* A4 width minus 10mm margin on each side */
    /* height: 190mm; */
    /* A4 height minus 10mm margin on each side */
    /* margin: auto;
            box-shadow: none !important;
            border-radius: 0;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            page-break-inside: avoid;
        } */

    /* Hide any unwanted elements */
    /* nav,
        .no-print,
        .btn,
        .actions {
            display: none !important;
        } */
    /* } */

    body {
        margin: 0;
        padding: 0;
    }

    #certificate_body {
        text-align: center;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        width: 100% !important;
        height: 100% !important;
    }



    @page {
        margin: 0;
        size: 930px 600px;
    }

    #cert_title {
        font-size: 22px;
        font-weight: 600;
        display: inline-block;
    }

    #cert_subtitle {
        font-size: 20px;
        font-weight: 400;
        display: inline-block;
        text-decoration: underline;
    }

    #cert_description {
        font-size: 17px;
        font-weight: 400;
        max-width: 75%;
    }

    #cert_signature {
        display: inline-block;
        object-fit: contain;
        max-width: 350px;
    }

    #cert_signature img {
        height: auto;
    }

    @foreach ($certificateItems as $cert_item)
        #{{ $cert_item->element_id }} {
            position: relative;
            left: {{ $cert_item->x_position }}px;
            top: {{ $cert_item->y_position }}px;
        }
    @endforeach
</style>

<body>
    <div id="certificate_body" style="background-image: url({{ public_path($certificate->background) }});">
        <div id="cert_title" class="draggable_item">{{ $certificate->title }}</div>
        <div id="cert_subtitle" class="draggable_item">{{ $certificate->subtitle }}</div>
        <div id="cert_description" class="draggable_item">{{ $certificate->description }}</div>
        <div id="cert_signature" class="draggable_item">
            <img src="{{ public_path($certificate->signature) }}" alt="Signature" id="signature_img"
                style="width: 350px; height: auto; object-fit: cover;">
        </div>
    </div>
</body>

</html>
