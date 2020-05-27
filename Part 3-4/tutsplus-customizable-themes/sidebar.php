<?php
/**
The Sidebar containing the after content widget area and the main sidebar widget area.
Widget areas are registered using action hooks - see the widgets.php file in the /includes folder for details.
 - if the widget areas aren't populate in the Widgets screen, nothing will appear.
Alternatively, add content within functions attached to the relevant action hooks.
*/

/* action hook for any content placed after the content and inside the content div, including the widget area */
do_action ( 'tutsplus_after_content' );

?>

</div><!-- #content -->

<?php

/* action hook for any content placed in the sidebar, including the widget areas */
do_action ( 'tutsplus_sidebar' );

?>