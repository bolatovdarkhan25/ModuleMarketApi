<?php


namespace App\Services\Redis;


use Redis;

class RedisCache
{
    /**
     * @var Redis
     */
    private Redis $redis;

    /**
     * RedisCache constructor.
     * @param int $index
     */
    public function __construct(int $index = 1)
    {
        $this->redis = new Redis();
        $this->redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
        $this->redis->select($index);
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value) {
        return json_decode($this->redis->set('module_tender:'.$key, $value), true);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key) {
        return json_decode($this->redis->get('module_tender:'.$key), true);
    }

    public function has($key, $value): bool
    {
        return $this->redis->get('module_tender:'.$key)==$value;
    }

    /**
     * @param $pattern
     * @param null $cursor
     * @return array
     */
    public function scan($pattern, $cursor = null): array
    {
        $keys = [];
        $this->redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);

        while ($arr_keys = $this->redis->scan($cursor, 'module_tender:'.$pattern)) {
            foreach ($arr_keys as $str_key) {
                if ($str_key != null) array_push($keys, $str_key);
            }
        }
        return $keys;
    }

    /**
     * @param $keys
     * @return int
     */
    public function del(...$keys): int
    {
        return $this->redis->del(...$keys);
    }

    /**
     * @param $key
     * @return bool|int
     */
    public function exists($key) {
        return $this->redis->exists('module_tender:'.$key);
    }

    public function close() {
        $this->redis->close();
    }

}
