@extends('layouts.master')
@section('title', config('app.name'))
@section('content')
<div class="container">
    <div class="row">
        <nav class="col-sm-3">
            <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
                <li class="active"><a href="#">Basic Sidenav</a></li>
                <li><a href="#">Section 1</a></li>
                <li><a href="#">Section 2</a></li>
                <li><a href="#">Section 3</a></li>
            </ul>
        </nav>

        <div class="col-sm-9">
            <h1>Affix plugin:</h1>
            <h2>1) allows an element to become locked to an area on the page</h2>
            <h2>2) usually used with nav menus or social icon buttons</h2>
            <h2>3) plugin toggles css position from static to fixed, depending on the scroll position</h2>
            <h2>4) e.g. affixed navbar / affixed sidebar</h2>
            <h2>5) add data-spy="affix" to element you want affixed</h2>
            <h2>6) (optional) add data-offset-top|bottom to calculate position of the scroll</h2>
            <h2>7) affix plugin toggles between the 3 classes: .affix, .affix-top, and .affix-bottom</h2>
            <h2>8) add css properties to handle the actual positions, except for position: fixed on the .affix class
            </h2>
            <h2>9) plugin adds the .affix-top and .affix-bottom class to indicate the element in its top-most or
                bottom-most position. positioning with css is not required at this point.</h2>
            <h2>10) scrolling past the affixed element triggers the actual affixing - this is where the plugin replaces
                the .affix-top or .affix-bottom class with the .affix class (sets position: fixed). at this point, you
                must add the css top or bottom property to position the affixed element in the page.</h2>
            <h2>11) if a bottom offset is defined, scrolling past it replaces the .affix class with the .affix-bottom.
                since offsets are optional, setting one requires the appropriate css. in this case, add position:
                absolute when necessary.</h2>
            <h2>12) in the previous eg, the affix plugin adds the .affix class (position: fixed) to the &lt;nav&gt;
                element after scrolling 197 pixels from the top. we added the css top property with a value of 0 to the
                .affix class. this is to make sure that the navbar stays at the top all the time, when we have scrolled
                197 pixels from the top.</h2>


        </div>
    </div>
</div>
@endsection