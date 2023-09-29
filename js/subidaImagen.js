import { Upload } from 'tus-js-client'

const projectId = ''
const token = ''

function uploadFile(bucketName, fileName, file) {
    return new Promise((resolve, reject) => {
        var upload = new Upload(file, {
            endpoint: `https://${projectId}.supabase.co/storage/v1/upload/resumable`,
            retryDelays: [0, 3000, 5000, 10000, 20000],
            headers: {
                authorization: `Bearer ${token}`,
                'x-upsert': 'true', // optionally set upsert to true to overwrite existing files
            },
            uploadDataDuringCreation: true,
            metadata: {
                bucketName: bucketName,
                objectName: fileName,
                contentType: 'image/png',
                cacheControl: 3600,
            },
            chunkSize: 6 * 1024 * 1024, // NOTE: it must be set to 6MB (for now) do not change it
            onError: function (error) {
                console.log('Failed because: ' + error)
                reject(error)
            },
            onProgress: function (bytesUploaded, bytesTotal) {
                var percentage = ((bytesUploaded / bytesTotal) * 100).toFixed(2)
                console.log(bytesUploaded, bytesTotal, percentage + '%')
            },
            onSuccess: function () {
                // console.log(upload)
                console.log('Download %s from %s', upload.file.name, upload.url)
                resolve()
            },
        })

        // Check if there are any previous uploads to continue.
        return upload.findPreviousUploads().then(function (previousUploads) {
            // Found previous uploads so we select the first one.
            if (previousUploads.length) {
                upload.resumeFromPreviousUpload(previousUploads[0])
            }

            // Start the upload
            upload.start()
        })
    })
}
