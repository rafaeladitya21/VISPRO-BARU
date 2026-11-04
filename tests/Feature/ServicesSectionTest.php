<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesSectionTest extends TestCase
{
    public function test_home_page_displays_premium_services_section_and_navigation(): void
    {
        $response = $this->get('/');

        $html = $response->getContent();
        $portfolioPosition = strpos($html, 'class="portofolio-section"');
        $servicesPosition = strpos($html, 'id="services"');

        $this->assertNotFalse($portfolioPosition);
        $this->assertNotFalse($servicesPosition);
        $this->assertGreaterThan($portfolioPosition, $servicesPosition);

        $response->assertOk()
            ->assertSee('href="#services"', false)
            ->assertSee('id="services"', false)
            ->assertSee('Solusi Multimedia Event')
            ->assertSee('Identik &amp; Megah', false)
            ->assertSee('Live Drone Aerial &amp; FPV', false)
            ->assertSee('DJI Mini 4 Pro')
            ->assertSee('DJI Air 3S')
            ->assertSee('Pavo 20 Pro: Size 2.2 inch, Kamera DJI O3')
            ->assertSee('Seeker 3: Size 3 inch, Kamera DJI O3')
            ->assertSee('Rp 850.000++')
            ->assertSee('Multicam &amp; Live Streaming', false)
            ->assertSee('Corporate Video &amp; Creative Ads', false)
            ->assertSee('Pesan Proposal')
            ->assertSee('wa.me/6285746642358', false)
            ->assertSee('images/SUNSET1.webp', false)
            ->assertSee('images/SUNSET14.webp', false)
            ->assertDontSee('images/SUNSET1.jpg', false)
            ->assertDontSee('images/SUNSET14.jpg', false);
    }
}
