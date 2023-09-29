import Uppy from '@uppy/core';
import '@uppy/core/dist/style.css';
import Supabase from '@uppy/supabase';
import '@uppy/supabase/dist/style.css';
require('dotenv').config();

const id_project = process.env.ID_PROJECT;
const apiKey = process.env.APIKEY;

const url = `https://${id_project}.supabase.co`;

const { createClient } = supabase;
const supabase = createClient(url, apiKey);

let uppy;
uppy = Uppy({
    meta: {type: 'img'},
    restrictions: {maxNumberOfFiles: 1},
    autoProceed: true,
});

uppy.use(Supabase, {
    serverUrl: url,
    serverHeaders: { Authorization: `Bearer ${supabase.auth.session().access_token}` },
    bucket: 'images',
});

uppy.on('complete', (result) => {
    console.log('Upload complete!', result.successful);
});

// Usage
uppy.addFile({
    name: 'example.jpg',
    type: 'image/jpeg',
    data: new Blob(['example image'], { type: 'image/jpeg' }),
});