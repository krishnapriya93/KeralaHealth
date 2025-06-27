<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.6; margin: 20px; }
        h1 { color: #1a202c; font-size: 20px; margin-top: 20px; }
        .logo { text-align: center; margin-bottom: 10px; }
        .logo img { width: 100px; }
        .meta { font-size: 12px; color: #555; margin-bottom: 10px; text-align: center; }
        .content { font-size: 14px; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #888; text-align: right; }
    </style>
</head>
<body>

   <div class="logo" style="text-align: center; margin-bottom: 20px;">
    <img src="{{ public_path('assets/frontend/images/log-n.png') }}" alt="Kerala Logo" style="width: 200px;">
      <div class="meta">Kerala Health Department,<br> Government of Kerala</div>
</div>

    <h1 style="text-align: center;">{{ $title }}</h1>
    
    <div class="meta">Date: {{ $date }}</div>
  
    
    <div class="content">{!! $description !!}</div>

    <div class="footer">
        Generated on {{ \Carbon\Carbon::now()->format('d F Y, h:i A') }}
    </div>

</body>
</html>
