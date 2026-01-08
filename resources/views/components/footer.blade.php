<footer class="bg-white border-t border-gray-200 pt-12 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <div class="col-span-1 md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    <span class="ml-3 text-xl font-bold text-gray-900">TestingFinal</span>
                </a>
                <p class="mt-4 text-gray-600 text-sm leading-relaxed">
                    Premium car rentals for your next adventure. Fast, easy, and reliable.
                </p>
            </div>

            <div>
                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Home</a></li>
                    <li><a href="/cars" class="text-gray-600 hover:text-indigo-600 transition-colors">Our Cars</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Special Offers</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Support</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">FAQs</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Get in Touch</h4>
                <p class="text-gray-600 text-sm">123 Rental Ave, City Center</p>
                <p class="text-gray-600 text-sm mt-1">support@testingfinal.test</p>
                <p class="text-gray-600 text-sm mt-1">+1 (555) 000-1234</p>
            </div>

        </div>

        <div class="border-t border-gray-100 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} TestingFinal. All rights reserved.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-gray-600">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-gray-600">Twitter</a>
                <a href="#" class="text-gray-400 hover:text-gray-600">Instagram</a>
            </div>
        </div>
    </div>
</footer>
