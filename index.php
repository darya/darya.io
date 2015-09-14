<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Darya - PHP Framework</title>
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Droid+Sans+Mono">
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Comfortaa:300,400,700"/>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/styles/tomorrow-night-eighties.min.css">
		<link rel="stylesheet" href="/assets/css/style.css"/>
		<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/highlight.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="assets/js/darya.js"></script>
	</head>
	<body>
		<div class="navbar navbar-default darya">
			<header class="container text-center darya">
				<div class="logo">
					<h1>
						<span class="alternate">D</span>ary<span class="alternate">a</span>
					</h1>
					<div class="circle"></div>
				</div>
				
				<h2>PHP Framework</h2>
			</header>
		</div>
		<div class="content">
			<section class="container">
				<h1>What is Darya?</h1>
				
				<p>
					Darya is a web development framework comprising of useful
					components that make common tasks easier without imposing a
					structure on your project.
				</p>
				
				<p>
					It aims to be as simple as possible without sacrificing
					expressivity.
				</p>
			</section>
			<section class="container">
				<h1>How does it look?</h1>
				<h2>Service container</h2>
				<pre class="example"><code class="php">
use Darya\Service\Container;

$container = new Container;

// Register a couple of services
$container->register(array(
	'App\FooInterface' => new App\ConcreteFoo,
	'App\BarInterface' => function (Container $container) {
		return new App\ConcreteBar($container->foo);
	}
));

// Register aliases for them
$container->alias('foo', 'App\FooInterface');
$container->alias('bar', 'App\BarInterface');

// Resolve services
$foo = $container->foo;                         // By alias
$foo = $container->resolve('App\FooInterface'); // By interface
$foo = $container->resolve('App\ConcreteFoo');  // By class

$container->bar instanceof App\BarInterface; // true
$container->bar === $container->bar;         // true
				</code></pre>
			</section>
			<section class="container">
				<h2>HTTP</h2>
				
				<h3>Requests</h3>
				
				<pre class="example"><code class="php">
use Darya\Http\Request;

$request = Request::createFromGlobals();

$username = $request->get('username');
$password = $request->post('password');
$uploaded = $request->file('uploaded');
$session  = $request->cookie('PHPSESSID');
$uri      = $request->server('PATH_INFO');
$ua       = $request->header('User-Agent');
				</code></pre>
				
				<h3>Responses</h3>
				<h4>Status &amp; content</h4>
				<pre class="example"><code class="php">
use Darya\Http\Response;

$response = new Response;

$response->status(200);
$response->content('Hello world!');
$response->send(); // Outputs 'Hello world!'
				</code></pre>
				
				<h4>Redirection</h4>
				<pre class="example"><code class="php">
$response->redirect('http://google.co.uk/');
$response->send();
				</code></pre>
				
				<h4>Cookies</h4>
				<pre class="example"><code class="php">
$response->cookies->set('key', 'value', strtotime('+1 day', time()));

$cookie = $response->cookies->get('key'); // 'value'

$response->cookies->delete('key');
				</code></pre>
				
				<h3>Sessions</h3>
				<pre class="example"><code class="php">
use Darya\Http\Session;

$session = new Session;
$session->start();

$session->set('key', 'value');
$session->has('key'); // true
$session->get('key'); // 'value'

// Alternative syntax
$session->key;   // 'another value';
$session['key']; // 'yet another value';

$session->delete('key');
$session->has('key'); // false;
				</code></pre>
				
				<h4>Response sessions</h4>
				<pre class="example"><code class="php">
$session = new Session;
$session->key = 'value';
$request = Request::createFromGlobals($session);

$request->session->key;   // 'value'
$request->session['key']; // 'value'
$request->session('key'); // 'value'
				</code></pre>
				
				<h3>Events</h3>
				<pre class="example"><code class="php">
use Darya\Events\Dispatcher;

$dispatcher = new Dispatcher;

$dispatcher->listen('some_event', function ($thing) {
    return "one $thing";
});

$dispatcher->listen('some_event', function ($thing) {
    return "two $thing" . 's';
});

$results = $dispatcher->dispatch('some_event', 'thing'); // array('one thing', 'two things');
				</code></pre>
				
			</section>

			<footer class="darya">
				<div class="container">
					<p><a target="_blank" href="https://github.com/darya/framework"><span class="fa fa-github"></span></a></p>
				</div>
			</footer>
		</div>
	</body>
</html>
