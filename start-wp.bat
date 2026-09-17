@echo off
cd /d "%~dp0"

docker info >nul 2>&1
if errorlevel 1 (
  echo Docker Desktop is not running.
  echo Open Docker Desktop, wait until it says Running, then run start-wp.bat again.
  pause
  exit /b 1
)

if not exist "custom-theme\style.css" (
  echo custom-theme folder is missing. Merge PR #7 first, then pull.
  pause
  exit /b 1
)

docker compose up -d
if errorlevel 1 (
  echo docker compose failed.
  pause
  exit /b 1
)

echo.
echo WordPress: http://127.0.0.1:8080
echo First time: complete the install, then Appearance - Themes - activate Creative Studio.
echo Permalinks: Settings - Permalinks - Post name - Save.
echo.
pause
