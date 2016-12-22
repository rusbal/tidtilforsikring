<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TTF</title>
    <style>
        body {
            font-size: 1.1em;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .json, .links {
            padding: 20px;
            background: #eee;
            color: darkgreen;
        }
        input, button {
            font-size: 1em;
        }
        .links {
            font-size: 0.75em;
        }
    </style>

</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <pre class="formula">{{ $formula }}</pre>
        <pre class="json">{{ $json }}</pre>
        <div class="form">
            <form action="">
                <input type="hidden" name="browser-test" value="1">
                <p><label> A: <input type="checkbox" name="a" value="1" {{ $params['a'] ? 'checked' : '' }}></label>
                   <label> B: <input type="checkbox" name="b" value="1" {{ $params['b'] ? 'checked' : '' }}></label>
                   <label> C: <input type="checkbox" name="c" value="1" {{ $params['c'] ? 'checked' : '' }}></label>
                   <label> Specialized: <input type="checkbox" name="specialized" value="1" {{ isset($params['specialized']) ? 'checked' : '' }}> </label></p>
                <p><label> D: <input type="text" name="d" value="{{ $params['d'] }}"></label></p>
                <p><label> E: <input type="text" name="e" value="{{ $params['e'] }}"></label></p>
                <p><label> F: <input type="text" name="f" value="{{ $params['f'] }}"></label></p>
                <p><button>Submit</button></p>
            </form>
        </div>
        <div class="links">
            <h3>Sample Computations:</h3>
            <ul>
                <li>
                    <a href="/insurance/?browser-test=1&a=0&b=0&c=0&d=10&e=20&f=30">Invalid input</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=1&b=1&c=0&d=10&e=20&f=30">Base Mapping S</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=1&b=1&c=1&d=10&e=20&f=30">Base Mapping R</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=0&b=1&c=1&d=10&e=20&f=30">Base Mapping T</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=1&b=0&c=1&d=10&e=20&f=30&specialized=1">Specialized Mapping S</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=1&b=1&c=1&d=10&e=20&f=30&specialized=1">Specialized Mapping R</a>
                </li>
                <li>
                    <a href="/insurance/?browser-test=1&a=1&b=1&c=0&d=10&e=20&f=30&specialized=1">Specialized Mapping T</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
