<?

$this->Azbn7->mdl('Session')->logout('user');

$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/'));
