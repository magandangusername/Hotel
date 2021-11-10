@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../mcred/detect-credit-card-type/card-detect
php "%BIN_TARGET%" %*
