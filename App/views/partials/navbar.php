<header style="background-color: #a3e2d7; padding: 1rem; border-bottom: 1px solid rgba(0,0,0,0.05);">
    <div style="width: 100%; max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; font-family: sans-serif;">
        
        <h1 style="font-size: 1.875rem; font-weight: bold; margin: 0; letter-spacing: -0.05em;">
            <a href="/" style="color: #000000; text-decoration: none;">Jobseek</a>
        </h1>
        
        <nav style="display: flex; align-items: center; gap: 0.75rem;">
            <?php if (isset($_SESSION['user'])) : ?>
                <span style="font-size: 0.95rem; font-weight: 500; color: #333333; margin-right: 0.5rem;">
                    Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>!
                </span>
                
                <a href="/listings/create"
                   style="background-color: #0cb5a0; color: #000000; padding: 0.6rem 1.2rem; border-radius: 0.5rem; text-decoration: none; font-weight: bold; font-size: 0.95rem; display: flex; align-items: center; gap: 0.35rem; border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <i class="fa fa-edit"></i> Post a Job
                </a>
                
                <form action="/auth/logout" method="POST" style="display: inline; margin: 0; padding: 0;">
                    <button type="submit" 
                            style="background-color: #0cb5a0; color: #000000; font-weight: bold; font-size: 0.95rem; padding: 0.6rem 1.2rem; border-radius: 0.5rem; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: sans-serif;">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            <?php else : ?>
                <a href="/auth/login" style="color: #000000; text-decoration: none; font-weight: bold; font-size: 0.95rem;">Login</a>
                <a href="/auth/register" style="color: #000000; text-decoration: none; font-weight: bold; font-size: 0.95rem; margin-left: 0.5rem;">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>