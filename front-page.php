<?php get_header(); ?>
<main class="main">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>

    <section class="space-y-16 py-14">


        <div class="kapitan-for-everyone">
            <div class="kapitan-for-everyone__inner">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/Namaste.svg" alt="Kapitan is for everyone who" class="kapitan-for-everyone__image" />
                <h2 class="kapitan-for-everyone__title">Kapitan is for everyone who</h2>
                <p class="kapitan-for-everyone__text opacity-65 font-medium">Kapitan is where great food meets good times. Enjoy tasty meals, cold drinks, and lively events with friends.
                </p>
                <p class="kapitan-for-everyone__quote">For the best memories</p>
            </div>
        </div>

        <div class="container grid grid-cols-2 gap-16 items-center">
            <div class="  overflow-hidden max-w-[490px] min-h-[559px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/cuisine.png" alt="Kapitan is for everyone who" class="w-full h-full object-cover" />
            </div>
            <div class="">
                <h2 class=" h2 mb-8">CUISINE</h2>
                <div class=" px-10 space-y-6">
                    <h3 class="text-[32px] ">OUR GOALS & HISTORY</h3>
                    <p class="opacity-65">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo et dolore magna aliqua. Ut enim ad mini veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                    <a href="#" class="button">READ MORE</a>
                </div>
            </div>

        </div>
        <div class="container grid grid-cols-2 gap-16 items-center">

            <div class="">
                <h2 class="h2 mb-8">CHEFS</h2>
                <div class=" px-10 space-y-6">
                    <h3 class="text-[32px] ">OVER 100 YEARS OF CULINARY EXCELLENCE</h3>
                    <p class="opacity-65">Our chefs bring over a century of masterful skill and passion, blending tradition with innovation to create exceptional dishes. With years of expertise, they craft each meal with precision, ensuring every bite delivers rich flavors and culinary excellence.</p>
                    <a href="#" class="button">READ MORE</a>
                </div>
            </div>

            <div class="relative">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/chefs-2.png" alt="Kapitan is for everyone who" class=" absolute bottom-8 left-0 aspect-square w-[211px]" />

                <div class=" overflow-hidden max-w-[490px] min-h-[559px] ml-auto">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/chefs.png" alt="Kapitan is for everyone who" class="w-full h-full object-cover" />
                </div>
            </div>


        </div>
    </section>

    <section class="bg-[url(<?php echo get_template_directory_uri(); ?>/assets/img/home/menu.png)] bg-cover bg-center bg-no-repeat h-[540px] w-full">
        <div class="container h-full flex items-center justify-center relative">
            <div class="absolute top-1/2 translate-y-1/2 left-0 w-full h-[1px] bg-white max-w-1/3"></div>
            <div class="absolute top-1/2 translate-y-1/2 right-0 w-full h-[1px] bg-white max-w-1/3"></div>

            <div class=" text-center">
                <p class=" font-jeju text-[80px] mb-2.5 uppercase leading-none"> MENU</p>
                <p class=" font-inter text-[20px] ">Main Couse</p>
            </div>
        </div>
    </section>
    <section class="py-[100px]">
        <div class="container grid grid-cols-3 gap-[100px] ">
            <div class="space-y-16">
                <div class="">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/bear.png" alt="Kapitan is for everyone who" width="346" height="894" />
                </div>

                <div class="px-[52px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/two-guys.png" alt="Kapitan is for everyone who" class="w-full h-full object-cover" />
                </div>
            </div>
            <div class="space-y-16 text-center">



                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <div>
                    <div class=" font-jeju text-2xl uppercase leading-none mb-2.5">
                        HOMEMADE SPREADS
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Rhombus.svg" alt="Kapitan is for everyone who" class=" w-6 block mx-auto mb-4" />
                    <p class=" opacity-65">
                        White fish roe ‘taramas’ 9€ <br />
                        Santorini Fava,split peas 9€ <br />
                        Aubergine puree (Mount Athos recipe) 8€
                    </p>
                </div>
                <a href="/menu" class="button mx-auto">ENTIRE MENU</a>
            </div>
            <div class="py-[100px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/dishes.png" alt="Kapitan is for everyone who" class="w-full h-full object-contain" />
            </div>
        </div>
    </section>

    <section class="pb-[100px]">
        <div class="container grid grid-cols-2 gap-16">
            <div class="">
                <h2 class="h2 mb-8">RESERVE</h2>
                <div class=" px-10">
                    <h3 class="text-[32px] uppercase mb-6 ">BOOK A TABLE</h3>
                    <form action="">
                        <div class="">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" />
                        </div>
                        <div class="">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" />
                        </div>
                        <div class="">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" />
                        </div>

                        <div class="">
                            <label for="persons">Persons</label>
                            <select id="persons" name="persons">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="more">More</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" />
                        </div>

                        <div class="">
                            <label for="time">Time</label>
                            <input type="datetime-local" id="time" name="time" />
                        </div>
                        <button type="submit" class="button">BOOK NOW</button>
                    </form>
                </div>
            </div>
            <div class="relative pl-[58px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/reservation.png" alt="Kapitan is for everyone who" class="" />
                <div class="absolute bottom-0 left-0 font-island text-5xl -rotate-4">Book private dining s
                    <br />
                    <span class="pl-[100px]"> & banquet room</span>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-blue py-[100px]">
        <div class="container grid grid-cols-2 items-center gap-[200px]">
            <div class="">
                <h2 class="h2 mb-8">GIVEAWAY</h2>
                <div class=" pl-[100px]">
                    <p class="max-w-[470px]">Rules of give away goes here!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut enim ad minim veniam, quis nostrud adipiscing elit, sed do eiusmod tempor ut enim ad minim veniam, quis nostrud</p>
                    <a href="#" class="button mt-6 max-w-[206px]">VIEW CONTEST RULES</a>
                </div>
            </div>
            <div class=" relative h-fit  pr-[58px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/giveaway.png" alt="Kapitan is for everyone who" class="w-full " />
                <div class="absolute bottom-0 right-0 font-island text-5xl -rotate-4">
                    <span class="text-white">Our weekly winners</span>

                </div>

            </div>

        </div>
    </section>


    <section class="py-[100px]">
        <div class="container space-y-16">
            <div class="text-center max-w-[448px] mx-auto">
                <div class="text-[32px] uppercase mb-2.5 leading-none">UPCOMING EVENTS</div>
                <p class="opacity-65">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor ut enim ad minim veniam, quis nostrud</p>
            </div>
            <div class="grid grid-cols-3 gap-[100px]">
                <div class="flex flex-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/event-1.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                    <div class=" mt-9 text-center space-y-4">
                        <div class=" uppercase">
                            COCKTAILS NIGHT
                        </div>
                        <div class="opacity-65">
                            <p>Friday, 21 Nov</p>
                            <p>Reservations 12Pm To 1.30Pm</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/event-2.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                    <div class=" mt-9 text-center space-y-4">
                        <div class=" uppercase">
                            FOOTBALL WEEKENDS
                        </div>
                        <div class="opacity-65">
                            <p>Saturday, 21 Nov</p>
                            <p>Reservations 12Pm To 1.30Pm</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/event-1.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                    <div class=" mt-9 text-center space-y-4">
                        <div class=" uppercase">
                            CHICKEN WINGS 50% OFF
                        </div>
                        <div class="opacity-65">
                            <p>Sunday, 21 Nov</p>
                            <p>Reservations 12Pm To 1.30Pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue py-[100px]">
        <div class="container grid grid-cols-2 items-center gap-[200px]">
            <div class=" relative h-fit  pr-[58px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/they-say.png" alt="Kapitan is for everyone who" class="w-full " />
                <div class="absolute bottom-0 right-0 font-island text-5xl -rotate-4">
                    <span class="text-white">Our gest say about us</span>

                </div>

            </div>
            <div class="">
                <h2 class="h2 mb-8">THEY SAY</h2>
                <div class=" pl-[100px]">
                    {# Это должен быть слайдер -> #}

                    <p class="max-w-[470px]">"I recently dined at [Restaurant Name], and it was a truly memorable experience! Whether you're looking for a cozy dinner spot or a place to celebrate a special occasion, [Restaurant Name] is the perfect choice!"</p>

                </div>
            </div>

        </div>
    </section>
    <section class="py-[100px]">
        <div class="container space-y-16">
            <div class="text-center max-w-[448px] mx-auto">
                <div class="text-[32px] uppercase mb-2.5 leading-none">CONNECT WITH US</div>
                <p class="opacity-65">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor ut enim ad minim veniam, quis nostrud</p>
            </div>
            <div class="grid grid-cols-4 gap-[100px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/menu.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/menu.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/menu.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/menu.png" alt="Kapitan is for everyone who" class="w-full object-cover" />
            </div>
            <p class="text-center text-[12px] mt-8">Inspired by you, always #kapitanpub</p>
        </div>

    </section>

    <section>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5241.763304694211!2d21.903428891957738!3d48.93669592131051!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473eb503b50b4127%3A0x560614b4875ec1b!2zWnJ1xaFlbsOp!5e0!3m2!1sru!2sca!4v1743005044501!5m2!1sru!2sca" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
</main>

<footer>
    <div class="container pb-6 border-b border-white/18">
        <div class="bg-blue -mt-16  pt-[50px] pb-[80px] px-[30px] relative z-10 ">
            <div class="grid grid-cols-3">
                <div class="grid grid-cols-2 gap-x-[40px] col-span-2">
                    <div class="flex gap-5 pb-7   border-b border-white/12 ">
                        <div class="h-full">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/address-icon.png" alt="address" class="w-[35px] h-[35px]" />
                        </div>
                        <div class="">
                            <div class=" font-semibold mb-4">Address</div>
                            <div>
                                <p>Tomášikova 40-41 </p>
                                <p>Bratislava | 831 04</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 pb-7  border-b border-white/12 ">
                        <div class="h-full">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Contact-icon.png" alt="contact" class="w-[33px] h-[33px]" />
                        </div>
                        <div class="">
                            <div class=" font-semibold mb-4">Contact</div>
                            <div>
                                <a href="tel:+421915169943" class=" block underline">+421915169943</a>
                                <a href="mailto:contact@kapitan.sk">contact@kapitan.sk</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 pb-7 pt-4   border-b border-white/12 ">
                        <div class="h-full">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Parking-icon.svg" alt="parging" class="w-[38px] h-[34px]" />
                        </div>
                        <div class="">
                            <div class=" font-semibold mb-4">Parking</div>
                            <div>
                                <p>Lorem ipsum dolor sit amet quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 flex gap-[20px]">
                    <div class="h-full">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hours-icon.png" alt="hours" class="w-[35px] h-[35px]" />
                    </div>
                    <div class="">
                        <div class=" font-semibold mb-4">Open hours</div>
                        <div>
                            <p>Monday: 11:00 AM – 9:00 PM</p>
                            <p>Tuesday: 11:00 AM – 10:00 PM</p>
                            <p>Wednesday: 11:00 AM – 10:00 PM</p>
                            <p>Thursday: 11:00 AM – 10:00 PM</p>
                            <p>Friday: 11:00 AM – 11:00 PM</p>
                            <p>Saturday: 11:00 AM – 11:00 PM</p>
                            <p>Sunday: 11:00 AM – 9:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-9">
                <div class="">
                    <div class="font-semibold mb-2.5">Waze</div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wase-qr.svg" alt="waze" class="w-[150px] aspect-square" />
                </div>
                <div class="mt-3">
                    <div class="font-semibold mb-2.5">Google</div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/google-qr.svg" alt="google" class="w-[150px] aspect-square" />
                </div>
            </div>
        </div>

        <div class=" mt-6 grid grid-cols-3 gap-8">
            <div class=" space-y-9">
                <div class="max-w-[201px] max-h-[89px]">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" aria-label="' . esc_attr(get_bloginfo('name')) . '">' . get_bloginfo('name') . '</a>';
                    }
                    ?>
                </div>
                <p class="max-w-[350px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
            </div>
            <div class="">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col text-center items-center justify-center',
                    'menu_id'        => 'header-menu',
                    'echo'           => true,
                    'fallback_cb'    => false,
                    'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation" aria-label="' . esc_attr__('Main menu', 'kapitan-pub') . '">%3$s</nav>',
                    'walker'         => new Custom_Walker_Nav_Menu(),
                ]);
                ?>
            </div>
            <div class="text-secondary text-right space-y-8">
                <div class="">
                    <div class=" font-montserrat text-lg font-semibold">Kontaktné údaje</div>
                    <a href="tel:+421915169943" class="font-montserrat text-lg  font-bold block underline">+421915169943</a>
                    <a href="mailto:contact@kapitan.sk" class="font-montserrat text-lg block">contact@kapitan.sk</a>
                </div>
                <div class="">
                    <div class=" text-lg font-semibold font-montserrat text-white bg-secondary w-fit ml-auto">Rezervácia</div>
                    <a href="mailto:reservations@kapitan.sk" class="font-montserrat text-lg block">reservations@kapitan.sk</a>
                </div>
            </div>
        </div>
    </div>
    <div class=" pt-12 pb-4 text-center container">
        <p class=" text-sm ">© 2025 Reštaurácia Kapitan</p>
        <div class="mt-8 flex max-w-[115px] mx-auto justify-between">
            <a href="facebook.com">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/facebook.svg" alt="facebook" class="w-[11px] h-[20px]" />
            </a>
            <a href="youtube.com">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/youtube.svg" alt="youtube" class="w-[20px] h-[20px]" />
            </a>
            <a href="instagram.com">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/instagram.svg" alt="instagram" class="w-[17px] h-[20px]" />
            </a>
        </div>
    </div>
</footer>
<?php get_footer(); ?>