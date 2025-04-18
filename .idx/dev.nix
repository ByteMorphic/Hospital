{pkgs}: {
  channel = "stable-24.11";
  packages = [
    pkgs.nodejs_22
    pkgs.php83Packages.composer
    pkgs.php83
    pkgs.heroku
    pkgs.gh
    pkgs.sqlite
    pkgs.sqlite-interactive
  ];
  idx.extensions = [
    "svelte.svelte-vscode"
    "vue.volar"
    "onecentlin.laravel5-snippets"
    "porifa.laravel-intelephense"
    "shufo.vscode-blade-formatter"
    "bradlc.vscode-tailwindcss"
    "Etsi0.class-collapse"
    "MrChetan.goto-laravel-components"
    "porifa.laraphense"
    "pkgs.vscode-extensions.github.copilot"
  ];
  idx.previews = {
    previews = {
      web = {
        command = [
          "npm"
          "run"
          "dev"
          "--"
          "--port"
          "$PORT"
          "--host"
          "0.0.0.0"
        ];
        manager = "web";
      };
    };
  };
}