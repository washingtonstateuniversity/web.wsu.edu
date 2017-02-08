<?php

if ( ! is_front_page() && ! is_home() && spine_display_breadcrumbs( 'bottom' ) ) {
	?><section class="row single breadcrumbs breadcrumbs-bottom gutter pad-top" typeof="BreadcrumbList" vocab="http://schema.org/">
	<div class="column one"><?php bcn_display(); ?></div>
	</section><?php
}

if ( is_page() && has_tag( '18f-accessibility' ) ) {
	?>
	<section class="row side-right gutter pad-ends attribution-text">
		<div class="column one">
			<p>The original text for this document was <a href="https://github.com/18F/accessibility">created by the 18F</a> and made available in the <a href="https://github.com/18F/accessibility/blob/18f-pages/LICENSE.md">public domain</a> under the <a href="https://creativecommons.org/publicdomain/zero/1.0/">CC0 1.0 Universal</a> license.</p>
			<p>Washington State University has made modifications to the original document. These changes are also licensed as <a href="https://creativecommons.org/publicdomain/zero/1.0/">CC0 1.0</a>. Please feel free to reuse this content.</p>
		</div>
		<div class="column two"></div>
	</section>
	<?php
}
