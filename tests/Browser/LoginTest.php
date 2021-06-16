<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Dashboard;

class LoginTest extends DuskTestCase
{
    public function testLoginMissingPassword()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit(new Login)
                ->type('@email', 'johndoe@example.com')
                ->type('@password', ' ')
                ->press('Login')
                ->waitForText('The password field is required')
                ->assertSee('The password field is required');
      });
    }

    public function testLoginIncorrectPassword()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit(new Login)
                ->type('@email', 'johndoe@example.com')
                ->type('@password', 'incorrect')
                ->press('Login')
                ->waitForText('These credentials do not match our records.')
                ->assertSee('These credentials do not match our records.');
      });
    }

    public function testLoginCorrectPassword()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit(new Login)
                ->type('@email', 'johndoe@example.com')
                ->type('@password', 'secret')
                ->press('Login')
                ->waitForText('Dashboard')
                ->on(new Dashboard);
      });
    }
}

