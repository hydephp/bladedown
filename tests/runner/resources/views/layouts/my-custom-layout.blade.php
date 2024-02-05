<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Layout</title>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || !('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.style.background = '#111827';
            document.documentElement.style.color = 'white';
        }
    </script>
</head>
<body>
    <article style="border: 4px solid {{ $background }}; padding: 0 1rem; margin: 2rem auto; max-width: 800px;">
        {{ $content }}
    </article>

    <footer style="text-align: center; margin-top: 2rem;">
        This is the custom layout.
    </footer>
</body>
</html>
