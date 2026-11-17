<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found | MSN World</title>

    {{-- SEO: Stop Indexing --}}
    <meta name="robots" content="noindex, nofollow">

    {{-- Structured Data for Google --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "404 Not Found",
      "description": "This page does not exist on MSN World.",
      "mainEntity": {
        "@type": "WebPageElement",
        "cssSelector": "body"
      }
    }
    </script>

    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <h1>404 - Page Not Found</h1>
    <p>This page doesn't exist on <strong>MSN World</strong>.</p>
    <a href="{{ url('/') }}">Go to Homepage</a>
</body>
</html>
