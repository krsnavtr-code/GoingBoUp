<style>
    footer {
  background: #0a0a23; /* Deep navy blue tone */
  color: #e5e5e5;
  font-family: "Poppins", sans-serif;
  padding-top: 60px;
  padding-bottom: 40px;
  line-height: 1.8;
  position: relative;
}

footer .nav_links {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 40px;
  margin-bottom: 40px;
}

.footer_block_title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #fff;
  margin-bottom: 20px;
  position: relative;
}

.footer_block_title::after {
  content: "";
  position: absolute;
  width: 40px;
  height: 3px;
  background: #007bff;
  bottom: -8px;
  left: 0;
  border-radius: 2px;
}

.footer_block_links {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.footer_block_links a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s ease, transform 0.3s ease;
  font-size: 0.95rem;
}

.footer_block_links a:hover {
  color: #fff;
  transform: translateX(4px);
}

/* --- Popular Destinations Section --- */
.destine {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding-top: 30px;
  margin-top: 30px;
}

.popular_destinations {
  margin-bottom: 25px;
  display: flex;
  flex-wrap: wrap;
  gap: 10px 15px;
  align-items: center;
}

.popular_destinations span:first-child {
  flex-basis: 100%;
  font-weight: 600;
  color: #fff;
  margin-bottom: 10px;
  font-size: 1.5rem;
}

.popular_destinations a {
  color: #9bc1ff;
  text-decoration: none;
  font-size: 1.2rem;
  transition: color 0.3s ease;
}

.popular_destinations a:hover {
  color: #fff;
  text-decoration: underline;
}

/* --- Copyright Section --- */
.copyright {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  margin-top: 40px;
  padding-top: 25px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}

.copyright img {
  height: 32px;
  opacity: 0.9;
}

.copyright p {
  color: #aaa;
  font-size: 0.9rem;
  margin: 0;
}

.copyright a {
  color: #fff;
  font-weight: 500;
  text-decoration: none;
}

.copyright a:hover {
  text-decoration: underline;
}

/* --- Responsive Styling --- */
@media (max-width: 768px) {
  footer {
    padding-inline: 25px;
  }

  .footer_block_title {
    font-size: 1rem;
  }

  .footer_block_links a {
    font-size: 0.9rem;
  }

  .popular_destinations {
    font-size: 0.9rem;
  }

  .copyright {
    flex-direction: column;
    text-align: center;
  }
}

</style>


<footer>
    <div style="padding-inline: 50px; ">
        <section class="row nav_links">
            <div class="col-6 col-m-3">
                <div class="wrapper footer_block">
                    <h6 class="footer_block_title">OUR PRODUCTS</h6>
                    <nav class="footer_block_links">
                        <a href="{{ url('hotel') }}">Domestic Hotels</a>
                        <a href="{{ url('hotel') }}">International Hotels</a>
                        <a href="{{ url('flight') }}">Domestic Flights</a>
                       
                        <a href="{{ url('packages')}}">GoingBo Stay Packages </a>
                        <a href="{{ url('hotel')}}">Couple Friendly Hotels</a>
                       
                        
                        

                        {{-- <a href="">Nearby Getaways</a>
                        <a href="">Bus Booking</a>
                        <a href="">Train Booking</a>                        
                        <a href="">Trip Money</a>
                        <a href="">Goibibo Advertising Solutions</a> --}}
                    </nav>
                </div>
            </div>
            <div class="col-6 col-m-3">
                <div class="wrapper footer_block">
                    <h6 class="footer_block_title">ABOUT US</h6>
                    <nav class="footer_block_links">
                        <a href="{{url('contact')}}"> Contact Us </a>
                        <a href="{{url('blogs')}}"> Blogs </a>
                        <a href="{{url('terms')}}"> Terms Policy </a>
                        <a href="{{url('refund')}}"> Refund Policy </a>
                        <a href="{{url('privacy')}}">Privacy Policy</a>

                        {{-- <a href="">About Us</a>
                        <a href="">Investor Relations</a>
                        <a href="">Management</a>                        
                        <a href="">User Agreement</a>                        
                        <a href="">Careers</a>
                        <a href="">YouTube Channel</a>
                        <a href="">Customer Support</a>
                        <a href="">Facebook Page</a>
                        <a href="">Twitter Handle</a> --}}
                    </nav>
                </div>
            </div>
            <div class="col-6 col-m-3">
                <div class="wrapper footer_block">
                    <h6 class="footer_block_title">TRAVEL ESSENTIALS</h6>
                    <nav class="footer_block_links">
                        <a href="{{url('membership')}}"> Membership </a>
                        <a href="{{ url('cab')}}">Cab Booking</a>
                        <a href="{{ url('cab/Airport-Transfer')}}">Airport Cabs Booking</a>
                        <a href="{{ url('cab/Daily-Rental')}}">Daily Rental Cabs Booking</a>
                        {{-- <a href="">PNR Status</a>
                        <a href="">Airline Routes</a>
                        <a href="">Train Running Status</a> --}}
                    </nav>
                </div>
            </div>
            <div class="col-6 col-m-3">
                <div class="wrapper footer_block">
                    <h6 class="footer_block_title">MORE LINKS</h6>
                    <nav class="footer_block_links">

                        <a href="{{ url('forex')}}"> Forex Currency </a>
                        <a href="{{ url('flight')}}">International Flights</a>
                        <a href="{{ url('hotel') }}">Hotels Near Me</a>                        
                        <a href="{{ url('flight') }}">Cheap Flights</a>

                        {{-- <a href="">My Bookings</a>
                        <a href="">Cancellation</a>
                        <a href="">My Account</a>
                        <a href="">Wallet</a>
                        <a href="">Advertise with Us</a> --}}
                    </nav>
                </div>
            </div>
        </section>
        <section class="destine">
            {{-- <div class="popular_destinations"><span>Popular Routes </span><span>Hotels in Delhi</span> <span>Hotels in   Mumbai</span> </div> --}}
            <div class="popular_destinations"> <span> Popular Flight Sectors </span>
                <span>  <a href={{url('flight/search?journey_type=1&from=CCU&to=DEL&dep_date=' . date("Y-m-d")) }} data-msg = "Getting Available Filghts..."> Kolkata to Delhi Flight </a> </span> 
                <span > <a href={{url('flight/search?journey_type=1&from=HYD&to=DEL&dep_date=' . date("Y-m-d"))}}   data-msg = "Getting Available Filghts..."> Hyderabad to Delhi Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=MAA&to=HYD&dep_date=' . date("Y-m-d"))}}   data-msg = "Getting Available Filghts..."> Chennai to Hyderabad Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=GAU&dep_date=' . date("Y-m-d"))}}   data-msg = "Getting Available Filghts..."> Delhi to Guwahati Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=LKO&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Lucknow to Delhi Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=NAG&to=BOM&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Nagpur to Mumbai Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=IXR&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Ranchi to Delhi Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=AMD&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Ahmedabad to Goa Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=IXC&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Mumbai to Chandigarh Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=PNQ&to=CCU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Pune to Kolkata Flight </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=BLR&to=BBI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Bangalore to Bhubaneshwar Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=BLR&to=GAU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Bangalore to Guwahati Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=MAA&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Chennai to Goa Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=GOI&to=CCU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Chennai to Kolkata Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=JAI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Jaipur Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=IXL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Leh Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=HYD&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Hyderabad to Goa Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=BLR&to=IXR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Bangalore to Ranchi Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=IXB&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Bagdogra Flight  </a> </span>
                <span> <a href={{url('flight/search?journey_type=1&from=SXR&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Srinagar to Delhi Flight </a> </span> 
             </div>
            <div class="popular_destinations"><span> Top Routes </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=IXC&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Chandigarh to Delhi Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BHO&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Bhopal Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=UDR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Udaipur Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=HYD&to=TIR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Hyderabad to Tirupati Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=CCU&to=MAA&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Kolkata to Chennai Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=CCU&to=GAU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Kolkata to Guwahati Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=ATQ&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Mumbai to Amritsar Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=IDR&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Indore to Goa Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=JAI&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Jaipur to Delhi Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=CCU&to=IXB&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">Kolkata to Bagdogra Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=PAT&to=BLR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Patna to Bangalore Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=VNS&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">Varanasi to Delhi Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=AMD&to=CCU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Ahmedabad to Kolkata Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=DEL&to=GOP&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Gorakhpur Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=GAU&to=CCU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Guwahati to Kolkata Flight </a></span>
                <span> <a href={{url('flight/search?journey_type=1&from=IDR&to=BLR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">Indore to Bangalore Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=JAI&to=PNQ&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Jaipur to Pune Flight </a></span>
                <span><a href={{url('flight/search?journey_type=1&from=BOM&to=RPR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Mumbai to Raipur Flight </a></span>
            </div>
            <div class="popular_destinations"><span>  Airline Sectors </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Goa Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BOM&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Mumbai Indigo Flight </a> </span>  
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Mumbai to Delhi Air India Flight </a> </span>  
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BOM&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Delhi to Mumbai Air India Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Delhi to Goa Air India Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Mumbai to Delhi Vistara Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=BLR&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Bangalore to Delhi Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BOM&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">   Delhi to Mumbai Vistara Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BLR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Delhi to Bangalore Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Mumbai to Delhi Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=HYD&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Delhi to Hyderabad Spicejet Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=BLR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Bangalore Air India Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=CCU&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Kolkata to Delhi Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=CCU&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Kolkata Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=DEL&to=PAT&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Delhi to Patna Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=PNQ&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts...">  Pune to Delhi Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=CCU&to=BLR&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Kolkata to Bangalore Indigo Flight </a> </span> 
                <span><a href={{url('flight/search?journey_type=1&from=BLR&to=DEL&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Bangalore to Delhi Air India Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=BLR&to=BOM&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Bangalore to Mumbai Indigo Flight </a> </span> 
                <span> <a href={{url('flight/search?journey_type=1&from=BOM&to=GOI&dep_date=' . date("Y-m-d"))}} data-msg = "Getting Available Filghts..."> Mumbai to Goa Indigo Flight </a> </span> 
            </div>
        </section>
        <!-- <section class="copyright">
            <img src = "{{url('images/web-assets/cards.png')}}" alt="image">
            <p>&copy; Copyright 2022-23 <a href="{{url('about')}}">Goingbo (INDIA)</a> All rights reserved</p>
        </section> -->
        <section class="copyright">
            <img src="{{ url('images/web-assets/cards.png') }}" alt="image  ">
            <p>
                &copy; Copyright 
                <span id="copyright-year"></span>
                <a href="{{ url('about') }}">Goingbo (INDIA)</a> All rights reserved
            </p>
        </section>
    </div>
</footer>

@push('js')
<script>
    const startYear = 2022;
    const currentYear = new Date().getFullYear();
    const displayYear = (startYear === currentYear) ? `${startYear}` : `${startYear}-${currentYear.toString().slice(-2)}`;
    document.getElementById('copyright-year').textContent = displayYear;
</script>
@endpush
