<?

echo '<p>установлено.</p>';
echo '<p><a href="' . $this->Azbn7->mdl('Site')->url('/помощь/') . '" >помощь</a> <a href="' . $this->Azbn7->mdl('Site')->url('/admin/') . '" >админка</a></p>';
echo '<p>версия PHP: ' . phpversion() . ' (' . $this->Azbn7->version['php'] . ')</p>';