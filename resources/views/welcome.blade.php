@extends('client.app')

@section('content')
<!-- Banner
================================================== -->
<div class="main-search-container centered" data-background-image="{{asset('img/client/background.png')}}">
			<div class="main-search-inner">

				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2>
								<!-- Typed words can be configured in script settings at the bottom of this HTML file -->
								<span class="typed-words"></span>
							</h2>
							<h4>Gobierno Regional de Tacna</h4>
                            
							<div class="main-search-input">

								<div class="main-search-input-item">
									<input type="text" placeholder="What are you looking for?" value="" />
								</div>

								<div class="main-search-input-item location">
									<div id="autocomplete-container">
										<input id="autocomplete-input" type="text" placeholder="Location">
									</div>
									<a href="#"><i class="fa fa-map-marker"></i></a>
								</div>

								<div class="main-search-input-item">
									<select data-placeholder="All Categories" class="chosen-select">
										<option>All Categories</option>
										<option>Shops</option>
										<option>Hotels</option>
										<option>Restaurants</option>
										<option>Fitness</option>
										<option>Events</option>
									</select>
								</div>

								<button class="button"
									onclick="window.location.href='listings-half-screen-map-list.html'">Search</button>

							</div>
						</div>
					</div>

					<!-- Features Categories -->
					<div class="row">
						<div class="col-md-12">
							<h5 class="highlighted-categories-headline">Contamos con el equipo mas clasificado:</h5>

							<div class="highlighted-categories">
								<!-- Box -->
								<a href="listings-list-with-sidebar.html" class="highlighted-category">
									<i class="im im-icon-Engineering"></i>
									<h4>Ingenieria</h4>
								</a>

								<!-- Box -->
								<a href="listings-list-full-width.html" class="highlighted-category">
									<i class="im im-icon-Business-Man"></i>
									<h4>Administracion</h4>
								</a>

								<!-- Box -->
								<a href="listings-half-screen-map-list.html" class="highlighted-category">
									<i class="im im-icon-Library"></i>
									<h4>Contabilidad</h4>
								</a>

								<!-- Box -->
								<a href="listings-half-screen-map-list.html" class="highlighted-category">
									<i class="im im-icon-Scale"></i>
									<h4>Derecho</h4>
								</a>
							</div>

						</div>
					</div>
					<!-- Featured Categories - End -->

				</div>

			</div>
		</div>


		<!-- Content
================================================== -->
		


<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Oportunidades de Trabajo Vigentes</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="#">Inicio</a></li>
						<li>Convocatorias</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Search -->
		{{--
            <div class="col-md-12">
			<div class="main-search-input gray-style margin-top-0 margin-bottom-10">

				<div class="main-search-input-item">
					<input type="text" placeholder="What are you looking for?" value=""/>
				</div>

				<div class="main-search-input-item location">
					<div id="autocomplete-container">
						<input id="autocomplete-input" type="text" placeholder="Location">
					</div>
					<a href="#"><i class="fa fa-map-marker"></i></a>
				</div>

				<div class="main-search-input-item">
					<select data-placeholder="All Categories" class="chosen-select" >
						<option>All Categories</option>	
						<option>Shops</option>
						<option>Hotels</option>
						<option>Restaurants</option>
						<option>Fitness</option>
						<option>Events</option>
					</select>
				</div>

				<button class="button">Search</button>
			</div>
		</div>
        
		<!-- Search Section / End -->

        --}}
		<div class="col-md-12">

			<!-- Sorting - Filtering Section -->
			<div class="row margin-bottom-25 margin-top-30">

				<div class="col-md-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						
					</div>
				</div>

				<div class="col-md-6">
					<div class="fullwidth-filters">
						
						<!-- Panel Dropdown / End -->

						<!-- Panel Dropdown / End -->

						<!-- Sort by -->
						<div class="sort-by">
							<div class="sort-by-select">
								<select data-placeholder="Default order" class="chosen-select-no-single">
									<option>CAS</option>	
									<option>Practicas</option>
								</select>
							</div>
                            <div class="sort-by-select">
								<select data-placeholder="Default order" class="chosen-select-no-single">
									<option>Abierta</option>	
									<option>Cerrada</option>
                                    <option>En Proceso</option>
                                    <option>Cancelada</option>
								</select>
							</div>
                            <div class="sort-by-select">
								<select data-placeholder="Default order" class="chosen-select-no-single">
									<option>2019</option>	
									<option>2020</option>
                                    <option selected>2021</option>
								</select>
							</div>
						</div>
						<!-- Sort by / End -->

					</div>
				</div>

			</div>
           
			<!-- Sorting - Filtering Section / End -->

			<div class="row">

				<!-- Listing Item -->
                @for($i = 0; $i < 20; $i++)
                    <div class="col-lg-12 col-md-12">
                        <div class="listing-item-container list-layout">
                            <a href="listings-single-page.html" class="listing-item">
                                
                                <!-- Image -->
                                <div class="listing-item-image">
                                    <img src="{{('img/client/logo_descarga.jpg')}}" alt="">
                                    <span class="tag">CAS</span>
                                </div>
                                
                                <!-- Content -->
                                <div class="listing-item-content">
                                    <div class="listing-badge now-open">Abierta</div>

                                    <div class="listing-item-inner col-md-8 padding-left-15" style="position: inherit;padding-right: 0px">
                                        <div class="col-md-12">
                                            <h4><strong>CONCURSO CAS N° 055-2020/GOB.REG.TACNA DEL ÓRGANO DE CONTROL INSTITUCIONAL </strong> </h4>
                                        </div>
                                        <div class="col-md-12">
                                            <span>CONCURSO CAS N°058-2021 GOB.REG.TACNA DE LA SUB GERENCIA DE PLANEAMIENTO Y ACONDICIONAMIENTO TERRITORIAL- Un (01) Analista de Planeamiento Institucional.- Un (01) Geógrafo</span>
                                        </div>
                                    </div>
                                    <div class="listing-item-inner col-md-4 padding-left-15" style="position: inherit;padding-right: 25px;">
                                        <div class="col-md-12">
                                            <strong>FECHA DE PUBLICACION</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <span>02/12/2021</span>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>FECHA DE POSTULACION</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <span>02/12/2021</span>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>MODALIDAD</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <span>PRACTICAS</span>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endfor
				
				<!-- Listing Item / End -->
                {{--
				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout">
						<a href="listings-single-page.html" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
                                <img src="{{('img/client/logo_descarga.jpg')}}" alt="">
								<span class="tag">Events</span>
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">

								<div class="listing-item-inner">
								<h3>Sticky Band</h3>
								<span>Bishop Avenue, New York</span>
									<div class="star-rating" data-rating="5.0">
										<div class="rating-counter">(23 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>

								<div class="listing-item-details">Friday, August 10</div>
							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout">
						<a href="listings-single-page.html" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
                                <img src="{{('img/client/logo_descarga.jpg')}}" alt="">
								<span class="tag">Hotels</span>
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">

								<div class="listing-item-inner">
								<h3>Hotel Govendor</h3>
								<span>778 Country Street, New York</span>
									<div class="star-rating" data-rating="2.0">
										<div class="rating-counter">(17 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>

								<div class="listing-item-details">Starting from $59 per night</div>
							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout">
						<a href="listings-single-page.html" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
                                <img src="{{('img/client/logo_descarga.jpg')}}" alt="">
								<span class="tag">Eat & Drink</span>
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">
								<div class="listing-badge now-open">Now Open</div>
								
								<div class="listing-item-inner">
								<h3>Burger House <i class="verified-icon"></i></h3>
								<span>2726 Shinn Street, New York</span>
									<div class="star-rating" data-rating="5.0">
										<div class="rating-counter">(31 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>
							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout">
						<a href="listings-single-page.html" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
                                <img src="{{('img/client/logo_descarga.jpg')}}" alt="">
								<span class="tag">Other</span>
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">

								<div class="listing-item-inner">
								<h3>Airport</h3>
								<span>1512 Duncan Avenue, New York</span>
									<div class="star-rating" data-rating="3.5">
										<div class="rating-counter">(46 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>
							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item / End -->
                --}}
				<!-- Listing Item / End -->

			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<!-- Pagination -->
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination">
							<ul>
								<li><a href="#" class="current-page">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!-- Pagination / End -->

		</div>

	</div>
</div>
		<!-- Recent Blog Posts / End -->
@endsection

<style>
.listing-item-container{
    height: auto !important;
}
.listing-item img{
    height: auto !important;
}
.listing-item-container.list-layout .listing-item-image:before {
    
     background-color: #27272900 !important; 
}
.listing-item-container.list-layout .listing-item img{
    margin-top: 10% !important;
}
.listing-item-container.list-layout .listing-item-image{
    height: auto !important;
}
.listing-item-container.list-layout .listing-item-inner{
    left: 0px !important;
}
#titlebar{
    margin-bottom : 0px !important;
}
</style>
@section('after-scripts')

@endsection