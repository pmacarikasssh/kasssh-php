# KassshClient PHP Package

The **KassshClient** package is a PHP client library for interacting with the Kasssh payment API. It provides a convenient and easy-to-use interface for making API requests, handling responses, and managing resources such as charges, customers, and stores.

## Installation

You can install the package via Composer. Run the following command:

```bash
composer require kasssh/kasssh-payment
```

## Usage

### Configuration

Before using the **KassshClient** package, you need to configure it with your API key and store ID. You can do this by calling the `config` method:

```php
use Kasssh\Payment\KassshClient;

KassshClient::config('your-api-key', 'your-store-id');
```

### Making API Requests

Once the **KassshClient** is configured, you can use it to make API requests. The supported HTTP methods are `GET`, `POST`, `PUT`, `PATCH`, and `DELETE`. The `request` method allows you to make API requests with the specified method, URL, and optional parameters:

```php
$response = KassshClient::request('get', 'charges');
```

The `request` method will automatically include your API key and store ID in the request headers and handle the API response. If the response status code is not successful (i.e., not in the range of 200-299), an `InvalidApiResponse` exception will be thrown.

### Available Resources

The **KassshClient** package provides convenient resource methods for interacting with different API resources: charges, customers, and stores. These resource methods are available as static methods on the **KassshClient** class.

#### Charge Resource

You can use the `charge` resource method to interact with the charge resource:

```php
use Kasssh\Payment\KassshClient;

$charge = KassshClient::charge();

// Create a charge
$charge->create([
    'amount' => 100,
    'currency' => 'GBP',
    'store_id' => 1,
    'vendor_id' => 101,
    //...
]);

// Retrieve a charge
$charge->get('token_123456789');

```

#### Customer Resource

You can use the `customer` resource method to interact with the customer resource:

```php
use Kasssh\Payment\KassshClient;

$customer = KassshClient::customer();

// send barcode email to customer
$customer->email('token_123456789');

```

#### Store Resource

You can use the `store` resource method to interact with the

 store resource:

```php
use Kasssh\Payment\KassshClient;

$store = KassshClient::store();

// Retrieve store information
$store->info();
```

### Error Handling

The **KassshClient** package throws several custom exceptions for different error scenarios:

- `HttpMethodNotSupported` exception is thrown if an unsupported HTTP method is used in the `request` method.
- `InvalidApiResponse` exception is thrown if the API response status code is not successful.
- `InvalidConfig` exception is thrown if the **KassshClient** is accessed without proper configuration.
- `InvalidResource` exception is thrown if an invalid resource name is used in the resource methods.

Make sure to handle these exceptions appropriately in your application.

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please open an issue or submit a pull request on the [GitHub repository](https://github.com/pmacarikasssh/kasssh-php).

## License

The **KassshClient** package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
