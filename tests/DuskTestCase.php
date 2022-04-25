<?php

namespace Tests;

use App\Models\Area;
use App\Models\Leilao;
use App\Models\Proposta;
use App\Models\Startup;
use App\Models\User;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;
use Laravel\Dusk\Browser;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        if (! static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed');
        $options = (new ChromeOptions)->addArguments(collect([
            '--window-size=1920,1080',
        ])->unless($this->hasHeadlessDisabled(), function ($items) {
            return $items->merge([
                '--disable-gpu',
                '--headless',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * Determine whether the Dusk command has disabled headless mode.
     *
     * @return bool
     */
    protected function hasHeadlessDisabled()
    {
        return isset($_SERVER['DUSK_HEADLESS_DISABLED']) ||
               isset($_ENV['DUSK_HEADLESS_DISABLED']);
    }

    /**
     * Resetar sessão do dusk
     * 
     * @return void
     */
    protected function resetar_session()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('home')
                    ->press('#btnperfil')
                    ->waitForText('Sair')
                    ->press('#btnsair');
        });
    }

    /**
     * Cria um leilão
     * 
     * @param User|null $user : User que o leilão será atribuida, caso não passado um novo usuário é criado
     * @return Proposta $proposta : Objeto de proposta
     */
    protected function criar_leilao(User $user = null)
    {
        if ($user == null) {
            $user = User::factory()->create();
        }
        $produto = $this->criar_proposta($user);
        return Leilao::factory()->createLeilao($produto);
    }

    /**
     * Cria um usuário e faz seu login.
     *
     * @param Browser $browser
     * @param User|null $user : Usuário que vai ser feito o login, caso não passado um novo usuário é criado
     * @return User $user : Usuário que foi feito o login
     */
    protected function login(Browser $browser, $user)
    {
        if ($user == null) {
            $user = User::factory()->create();
        }
        $browser->loginAs($user);
        return $user;
    }

    /**
     * Cria uma proposta
     * 
     * @param User|null $user : User que a proposta será atribuida, caso não passado um novo usuário é criado
     * @return Proposta $proposta : Objeto de proposta
     */
    protected function criar_proposta(User $user = null) 
    {   
        if ($user == null) {
            $user = User::factory()->create();
        }
        $startup = $this->criar_startup($user);
        return Proposta::factory()->createProposta($startup);
    }

    /**
     * Cria uma startup
     * 
     * @param User|null $user : User que a startup será atribuida, caso não passado um novo usuário é criado
     * @return Startup $startup : Objeto de startup
     */
    protected function criar_startup(User $user = null)
    {
        if ($user == null) {
            $user = User::factory()->create();
        }
        $area = Area::factory()->create();
        return Startup::factory()->createStartup($user, $area);
    }
}
