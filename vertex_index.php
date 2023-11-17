<?php

// ensures fresh loading of CSS, because browsers seem to like to cache this
$css_version = time() ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>My Vertex AI Search Widget</title>
</head>
<body>
<!-- Widget JavaScript bundle -->
<script src="https://cloud.google.com/ai/gen-app-builder/client?hl=en_US"></script>

<!-- Search widget element is not visible by default -->
<gen-search-widget
  configId="YOUR-SECRET-GOOGLE-KEY-GOES-HERE"
  triggerId="searchWidgetTrigger">
</gen-search-widget>

<!-- Element that opens the widget on click. It can be almost any kind of element, it doesn't have to be a div -->
<div id="searchWidgetTrigger" style="text-decoration : underline ; ">Search me</div>

<!-- Append styles to shadow root -->
<script>
function applyStylesToShadowRoot(element) {
	// Create the style tag
	var link = document.createElement("link");
	// Set attributes for the link tag
	link.setAttribute("href", "vertex_search.css?<?php echo $css_version ; ?>");
	link.setAttribute("rel", "stylesheet");
	link.setAttribute("id", "my-awesome-vertex-search-css");
	link.setAttribute("type", "text/css");
	link.setAttribute("media", "all");

	if (element.shadowRoot) {
		// Append the style tag to the shadow root
		element.shadowRoot.appendChild(link);

		// Recursively apply styles to all nested shadow roots
		element.shadowRoot.querySelectorAll('*').forEach(nestedElement => {
			applyStylesToShadowRoot(nestedElement);
		});
	}
}

function doStuff() {
	document.querySelectorAll('*').forEach(element => {
		applyStylesToShadowRoot(element);
	});
}

const fullbtn = document.querySelector('#searchWidgetTrigger');

// Set a timeout to ensure the content is loaded before applying styles
fullbtn.addEventListener('click', () => setTimeout(function() {
	doStuff();
}, 100));
</script>

</body>
</html>
