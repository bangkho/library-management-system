import React from 'react'

function PageNotFound() {
  return (
    <section class="py-14 2xl:pt-14 2xl:pb-32 bg-gray-50 overflow-hidden">
      <div class="relative container px-4 mx-auto">
        <div class="relative text-center py-12 md:py-24 px-4 2xl:pt-36 2xl:pb-60 bg-white rounded-7xl z-20">
          <div class="relative z-40">
            <span class="block mb-9 uppercase tracking-widest text-xs text-gray-300">Can&apos;t find</span>
            <h2 class="mb-6 font-medium font-heading text-9xl md:text-10xl xl:text-smxl leading-tight">404</h2>
            <p class="max-w-md mb-20 xl:mb-24 mx-auto font-heading font-medium text-3xl leading-10">Wooops. We can&rsquo;t find that page or something has gone wrong.</p>
            <a class="inline-flex items-center pb-2 font-bold tracking-tight text-xl leading-6 text-green-600 hover:text-green-700 border-b border-green-600 hover:border-green-700" href="#">
              <span onClick={()=>location.href = '/'} class="mr-3">Back to home</span>
              <svg width="16" height="13" viewbox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.8 1L15 7H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M11 12L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
  )
}

export default PageNotFound