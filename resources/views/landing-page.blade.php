<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen bg-yellow-100">
        <!-- header -->
        <header class="text-gray-600 body-font">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-2xl text-yellow-500">Zen</span>
                <span class="text-2xl">Tech</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900">Home</a>
                <a class="mr-5 hover:text-gray-900">Product</a>
                <a class="mr-5 hover:text-gray-900">Documents</a>
                </nav>
                <button class="inline-flex items-center font-bold bg-white text-yellow-500 border-2 border-yellow-500 py-2 px-4 rounded-lg focus:outline-none hover:bg-yellow-500 hover:text-white transition-all duration-300 ease-in-out mt-4 md:mt-0">Login
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
                </button>
            </div>
        </header>
        <!-- end header -->

        <!-- body content -->
        <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-6xl text-5xl mb-7 font-medium text-gray-900">ZenTech</h1>
                <h3 class="title-font sm:text-5xl text-4xl mb-7 font-semi text-gray-900">Zen Technology Open Source <span class="text-yellow-500">E-commerce</span></h3>
                <p class="mb-2 leading-relaxed text-xl">- A global open source e-commerce system, a culmination of 15 years of continuous industry experience</p>
                <p class="mb-2 leading-relaxed text-xl">- User-friendly, intuitive interface, quick to get started, drag-and-drop design, no need for complex training</p>
                <p class="mb-2 leading-relaxed text-xl">- Based on the latest technology, deeply integrated with AI, supports multiple languages and currencies</p>
                <p class="mb-10 leading-relaxed text-xl">- Highly cohesive, low-coupling modular design, simple and convenient to quickly develop plug-ins</p>
                <div class="flex w-full md:justify-start justify-center items-end">
                <div class="flex lg:flex-row md:flex-col">
                    <button class="bg-gray-100 inline-flex py-3 px-4 rounded-lg items-center hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z"></path></svg>
                    <span class="ml-4 flex items-start flex-col leading-none">
                        <span class="text-xs text-gray-600 mb-1">GET IT ON</span>
                        <span class="title-font font-medium">GitHub</span>
                    </span>
                    </button>
                    <button class="inline-flex text-white bg-yellow-500 border-0 py-3 px-5 focus:outline-none hover:bg-yellow-600 rounded text-lg font-semibold ml-5">Try Now</button>
                </div>
                </div>
                </div>
            </div>
        </section>

        <!-- ecommerce display -->
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                <h2 class="text-xs text-yellow-500 tracking-widest font-medium title-font mb-1">Documents of</h2>
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Our Products</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them man bun deep jianbing selfies heirloom prism food truck ugh squid celiac humblebrag.</p>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-wrap -m-4">
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/420x260">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                            <p class="mt-1">$16.00</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/421x261">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">Shooting Stars</h2>
                            <p class="mt-1">$21.15</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/422x262">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">Neptune</h2>
                            <p class="mt-1">$12.00</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/423x263">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">The 400 Blows</h2>
                            <p class="mt-1">$18.40</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/424x264">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                            <p class="mt-1">$16.00</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/425x265">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">Shooting Stars</h2>
                            <p class="mt-1">$21.15</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/427x267">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">Neptune</h2>
                            <p class="mt-1">$12.00</p>
                            </div>
                        </div>
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                            <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/428x268">
                            </a>
                            <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">CATEGORY</h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">The 400 Blows</h2>
                            <p class="mt-1">$18.40</p>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Our Features -->
                    <div class="container mx-auto flex px-5 md:flex-row flex-col items-center">
                        <!-- Konten (Kiri) -->
                        <div class="lg:w-1/2 w-full flex flex-col space-y-10">
                            <!-- Fitur 1 -->
                            <div class="flex items-center border-b pb-6 mb-6 border-gray-200">
                                <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                    </svg>
                                </div>
                                <div class="ml-6 flex-grow">
                                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">Shooting Stars</h2>
                                    <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                                    <a class="mt-3 text-yellow-500 inline-flex items-center">
                                        Learn More
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <!-- Fitur 2 -->
                            <div class="flex items-center border-b pb-6 mb-6 border-gray-200">
                                <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <circle cx="6" cy="6" r="3"></circle>
                                        <circle cx="6" cy="18" r="3"></circle>
                                        <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
                                    </svg>
                                </div>
                                <div class="ml-6 flex-grow">
                                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">The Catalyzer</h2>
                                    <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                                    <a class="mt-3 text-yellow-500 inline-flex items-center">
                                        Learn More
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Gambar (Kanan) -->
                        <div class="lg:max-w-lg lg:w-1/2 w-full ml-20">
                            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                        </div>
                    </div>

                    <div class="container mx-auto flex px-5 md:flex-row flex-col items-center">
                        <!-- Gambar (Kiri) -->
                        <div class="lg:max-w-lg lg:w-1/2 w-full">
                            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                        </div>
                        <!-- Konten (Kanan) -->
                        <div class="lg:w-1/2 w-full flex flex-col space-y-10 ml-20 mt-16">
                            <!-- Fitur 3 -->
                            <div class="flex items-center border-b pb-6 mb-6 border-gray-200">
                                <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                    </svg>
                                </div>
                                <div class="ml-6 flex-grow">
                                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">Shooting Stars</h2>
                                    <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                                    <a class="mt-3 text-yellow-500 inline-flex items-center">
                                        Learn More
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <!-- Fitur 4 -->
                            <div class="flex items-center border-b pb-6 mb-6 border-gray-200">
                                <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <circle cx="6" cy="6" r="3"></circle>
                                        <circle cx="6" cy="18" r="3"></circle>
                                        <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
                                    </svg>
                                </div>
                                <div class="ml-6 mt-16 flex-grow">
                                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">The Catalyzer</h2>
                                    <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                                    <a class="mt-3 text-yellow-500 inline-flex items-center">
                                        Learn More
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

               <!-- contact us -->
                <section class="text-gray-600 body-font">
                    <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                        <div class="text-center lg:w-2/3 w-full">
                            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Contact Us</h1>
                            <p class="mb-8 leading-relaxed">If you need to get in touch with us, here are our contact details:</p>
                        </div>
                        <img class="lg:w-2/6 md:w-3/6 w-5/6 object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                    </div>
                    <div class="flex flex-wrap justify-center -m-4">
                        <!-- Contact Email -->
                        <div class="p-4 md:w-1/3">
                            <div class="flex flex-col items-center rounded-lg bg-gray-100 p-8">
                                <div class="w-16 h-16 mb-4 inline-flex items-center justify-center rounded-full bg-yellow-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2H8a2 2 0 00-2 2v16a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2zM9 16h6M9 12h6M9 8h2"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-medium text-gray-900 mb-2">Contact Email</h2>
                                <p class="leading-relaxed text-base text-yellow-500">team@zentech.com</p>
                            </div>
                        </div>
                        <!-- Telegram -->
                        <div class="p-4 md:w-1/3">
                            <div class="flex flex-col items-center rounded-lg bg-gray-100 p-8">
                                <div class="w-16 h-16 mb-4 inline-flex items-center justify-center rounded-full bg-yellow-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(243, 238, 238, 1);"><path d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"></path></svg>
                                </div>
                                <h2 class="text-lg font-medium text-gray-900 mb-2">Telegram</h2>
                                <p class="leading-relaxed text-base text-yellow-500">@zentech_com</p>
                            </div>
                        </div>
                        <!-- Telegram Group -->
                        <div class="p-4 md:w-1/3">
                            <div class="flex flex-col items-center rounded-lg bg-gray-100 p-8">
                                <div class="w-16 h-16 mb-4 inline-flex items-center justify-center rounded-full bg-yellow-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(243, 238, 238, 1);"><path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path><circle cx="16.806" cy="7.207" r="1.078"></circle><path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path></svg>
                                </div>
                                <h2 class="text-lg font-medium text-gray-900 mb-2">Instagram</h2>
                                <p class="leading-relaxed text-base text-yellow-500">@ZenTech_</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
        <!-- end body content -->

        <!-- footer -->
        <footer class="text-gray-600 body-font">
            <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">Zen</span>
                <span class="text-xl text-yellow-500">Tech</span>
                </a>
                <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2024 Zentech —
                <a href="https://twitter.com/knyttneve" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@Zentech</a>
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                    <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
                </span>
            </div>
        </footer>
        <!-- end footer -->
    </div>
</body>
</html>